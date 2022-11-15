<?php

namespace App\Http\Controllers;

use App\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TokoController extends Controller
{
    public function index()
    {
        $data = Toko::get();
        foreach($data as $datas)
        {
            $datas->image = asset('/images/toko/' .$datas->image);
        }
        return apiResponse(200, 'success', 'Toko semua data', $data);
    }

    public function show($id)
    {
        $data = Toko::where('id', $id)->with('tokoToProduk')->first();
        $data->image = asset('/images/toko/' .$data->image);
        // dd($data);
        return apiResponse(200, 'success', 'Toko show data', $data);
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
            $destination = base_path('public/images/toko');
            $request->file('image')->move($destination,$image);

            $toko = Toko::create([
                'id_user'  => $request->id_user,
                'name'     => $request->name,
                'address'  => $request->address,
                'phone'    => $request->phone,
                'image'    => $image,
                'status'   => $request->status,
            ]);

            $toko->image = asset('/images/toko/' .$toko->image);

            return apiResponse(201, 'success', 'Toko berhasil ditambah', $toko);
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
            $fileName = Toko::where('id', $id)->first()->image;

            if($fileName)
            {
                $pleaseRemove = base_path('public/images/toko/').$fileName;

                if(file_exists($pleaseRemove)) {
                    unlink($pleaseRemove);
                }
            }

            $extension = $request->file('image')->getClientOriginalExtension();
            $image = strtotime(date('Y-m-d H:i:s')).'.'.$extension;
            $destination = base_path('public/images/toko');
            $request->file('image')->move($destination, $image);

            Toko::where('id', $id)->update([
                'id_user'  => $request->id_user,
                'name'     => $request->name,
                'address'  => $request->address,
                'phone'    => $request->phone,
                'image'    => $image,
                'status'   => $request->status,
            ]);

            $toko = Toko::where('id', $id)->first();
            $toko->image = asset('/images/toko/' .$toko->image);

            return apiResponse(202, 'success', 'Toko berhasil disunting', $toko);
        } catch (Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }

    public function destroy($id)
    {
        try {

            $fileName = Toko::where('id', $id)->first()->image;
            $pleaseRemove = base_path('public/images/toko/').$fileName;

            if(file_exists($pleaseRemove)) {
                unlink($pleaseRemove);
            }

            Toko::where('id', $id)->delete();
            return apiResponse(202, 'success', 'Toko berhasil dihapus');
        } catch (Exception $e) {
            return apiResponse(400, 'gagal', 'error', $e);
        }
    }
}

