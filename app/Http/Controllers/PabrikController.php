<?php

namespace App\Http\Controllers;

use App\Pabrik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PabrikController extends Controller
{
    public function index()
    {
        return apiResponse(200, 'success', 'Pabrik semua data', Pabrik::get());
    }

    public function show($id)
    {
        return apiResponse(200, 'success', 'Pabrik show data', Pabrik::where('id', $id)->get());
    }
    
    public function store(Request $request){

        $rules = [
            'id_user' => 'required',
            'name'    => 'required',
            'address' => 'required',
            'phone'   => 'required',
            'image'   => 'required',
            'status'  => 'required',
        ];
        $message = [
            'id_user.required' => 'mohon isikan id pabrik nya bro',
            'name.required'    => 'mohon isikan nama nya bro',
            'address.required' => 'mohon isikan alamat nya bro',
            'phone.required'   => 'mohon isikan nomer telpon nya bro',
            'image.required'   => 'mohon isikan gambar nya bro',
            'status.required'  => 'mohon isikan status nya bro',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return apiResponse(400, 'error', 'Data tidak lengkap ', $validator->errors());
        }
        try{
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = strtotime(date('Y-m-d H:i:s')).'.'.$extension;
            $destination = base_path('public/images/pabrik');
            $request->file('image')->move($destination,$image);

            $pabrik = Pabrik::create([
                'id_user'  => $request->id_user,
                'name'     => $request->name,
                'address'  => $request->address,
                'phone'    => $request->phone,
                'image'    => $image,
                'status'   => $request->status,
            ]);

            return apiResponse(201, 'success', 'Pabrik berhasil ditambah', $pabrik);
        } catch(Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'id_user' => 'required',
            'name'    => 'required',
            'address' => 'required',
            'phone'   => 'required',
            'image'   => 'required',
            'status'  => 'required',
        ];
        $message = [
            'id_user.required' => 'mohon isikan id pabrik nya bro',
            'name.required'    => 'mohon isikan nama nya bro',
            'address.required' => 'mohon isikan alamat nya bro',
            'phone.required'   => 'mohon isikan nomer telpon nya bro',
            'image.required'   => 'mohon isikan gambar nya bro',
            'status.required'  => 'mohon isikan status nya bro',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return apiResponse(400, 'error', 'Data tidak lengkap ', $validator->errors());
        }
        try{
            $fileName = Pabrik::where('id', $id)->first()->image;

            if($fileName)
            {
                $pleaseRemove = base_path('public/images/pabrik').$fileName;

                if(file_exists($pleaseRemove)) {
                    unlink($pleaseRemove);
                }
            }

            $extension = $request->file('image')->getClientOriginalExtension();
            $image = strtotime(date('Y-m-d H:i:s')).'.'.$extension;
            $destination = base_path('public/images/pabrik');
            $request->file('image')->move($destination, $image);

            Pabrik::where('id', $id)->update([
                'id_user'  => $request->id_user,
                'name'     => $request->name,
                'address'  => $request->address,
                'phone'    => $request->phone,
                'image'    => $image,
                'status'   => $request->status,
            ]);

            $pabrik = Pabrik::where('id', $id)->get();

            return apiResponse(202, 'success', 'Pabrik berhasil disunting', $pabrik);
        } catch (Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }

    public function destroy($id)
    {
        try {
            Pabrik::where('id', $id)->delete();
            return apiResponse(202, 'success', 'Pabrik berhasil dihapus');
        } catch (Exception $e) {
            return apiResponse(400, 'gagal', 'error', $e);
        }
    }
}
