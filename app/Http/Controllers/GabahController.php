<?php

namespace App\Http\Controllers;

use App\Gabah;
use Illuminate\Http\Request;
use App\Http\Requests\GabahRequest;
use Illuminate\Support\Facades\Validator;

class GabahController extends Controller
{
    public function index()
    {
        $data = Gabah::get();
        foreach($data as $datas)
        {
            $datas->image = asset('/images/gabah/' .$datas->image);
        }
        return apiResponse(200, 'success', 'Gabah semua data', $data);
    }

    public function show($id)
    {
        $data = Gabah::where('id', $id)->first();
        $data->image = asset('/images/gabah/' .$data->image);
        return apiResponse(200, 'success', 'Gabah show data', $data);
    }
    
    public function store(Request $request){

        $rules = [
            'id_pabrik' => 'required',
            'name'      => 'required',
            'detail'    => 'required',
            'price'     => 'required',
            'image'     => 'required',
        ];
        $message = [
            'id_pabrik.required' => 'mohon isikan id pabrik ',
            'name.required'      => 'mohon isikan nama nya bro',
            'detail.required'    => 'mohon isikan detail nya bro',
            'price.required'     => 'mohon isikan harga nya bro',
            'image.required'     => 'mohon isikan gambar nya bro',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return apiResponse(400, 'error', 'Data tidak lengkap ', $validator->errors());
        }
        try{
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = strtotime(date('Y-m-d H:i:s')).'.'.$extension;
            $destination = base_path('public/images/gabah');
            $request->file('image')->move($destination,$image);

            $gabah = Gabah::create([
                'id_pabrik' => $request->id_pabrik,
                'name'      => $request->name,
                'detail'    => $request->detail,
                'price'     => $request->price,
                'image'     => $image,
            ]);

            $gabah->image = asset('/images/gabah/' .$gabah->image);

            return apiResponse(201, 'success', 'Gabah berhasil ditambah', $gabah);
        } catch(Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'id_pabrik' => 'required',
            'name'      => 'required',
            'detail'    => 'required',
            'price'     => 'required',
            'image'     => 'required',
        ];
        $message = [
            'id_pabrik.required' => 'mohon isikan id pabrik ',
            'name.required'      => 'mohon isikan nama nya bro',
            'detail.required'    => 'mohon isikan detail nya bro',
            'price.required'     => 'mohon isikan harga nya bro',
            'image.required'     => 'mohon isikan gambar nya bro',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return apiResponse(400, 'error', 'Data tidak lengkap ', $validator->errors());
        }
        try{
            $fileName = Gabah::where('id', $id)->first()->image;

            if($fileName)
            {
                $pleaseRemove = base_path('public/images/gabah/').$fileName;

                if(file_exists($pleaseRemove)) {
                    unlink($pleaseRemove);
                }
            }

            $extension = $request->file('image')->getClientOriginalExtension();
            $image = strtotime(date('Y-m-d H:i:s')).'.'.$extension;
            $destination = base_path('public/images/gabah');
            $request->file('image')->move($destination, $image);

            Gabah::where('id', $id)->update([
                'id_pabrik' => $request->id_pabrik,
                'name'      => $request->name,
                'detail'    => $request->detail,
                'price'     => $request->price,
                'image'     => $image,
            ]);

            $gabah = Gabah::where('id', $id)->first();
            $gabah->image = asset('/images/gabah/' .$gabah->image);

            return apiResponse(202, 'success', 'Gabah berhasil disunting', $gabah);
        } catch (Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }

    public function destroy($id)
    {
        try {
            $fileName = Gabah::where('id', $id)->first()->image;
            $pleaseRemove = base_path('public/images/gabah/').$fileName;

            if(file_exists($pleaseRemove)) {
                unlink($pleaseRemove);
            }
            Gabah::where('id', $id)->delete();
            return apiResponse(202, 'success', 'Gabah berhasil dihapus');
        } catch (Exception $e) {
            return apiResponse(400, 'gagal', 'error', $e);
        }
    }
}
