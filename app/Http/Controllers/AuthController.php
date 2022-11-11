<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use App\UserDetail;
use Laravel\Passport\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\RefreshToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
        $message = [
            'email.required' => 'Mohon Isikan Email anda',
            'email.email' => 'Mohon Isi email dengan benar',
            'password.required' => 'Mohon isi password anda',
            'password.min' => 'password minimal 8 karakter',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return apiResponse(400, 'error', 'Data tidak lengkap ', $validator->errors());
        }
        $data = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];
        if (!Auth::attempt($data)) {
            return apiResponse(400, 'error', 'Data tidak terdaftar, akun bodong nya?');
        }

        $token = Auth::user()->createToken('API Token')->accessToken;

        $data   = [
            'token'     => $token,
            'user'      => Auth::user()->detail,
        ];
        return apiResponse(200, 'success', 'Selamat anda berhasil Login', $data);
    }
    public function signup(Request $request ){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'photo_profile' => 'required',
            'photo_id' => 'required',
            'role' => 'required',
        ]);
        try{
            DB::transaction(function ()use($request) {
                $id = User::insertGetId([
                    'name'=>request('name'),
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'created_at'=>date('Y-m-d H-i-s')
                ]);
                UserDetail::insert([
                    'id_user' => $id,
                    'adddress' => $request->adddress,
                    'phone' => $request->phone,
                    'photo_profile' => $request->photo_profile,
                    'photo_id' => $request->photo_id,
                    'role' => $request->role,
                    'created_at' => date('Y-m-d H-i-s')
                ]);
            });
            return apiResponse(201, 'success', 'user berhasil daftar');
        } catch(Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }
    public function logout()
    {
        if (Auth::user()) {
            $tokens = Auth::user()->tokens->pluck('id');

            Token::whereIn('id', $tokens)->update([
                'revoked' => true,
            ]);
            RefreshToken::whereIn('access_token_id', $tokens)->update([
                'revoked' => true
            ]);
        }
        return apiResponse(200, 'success', 'berhasil logout');
    }
}
