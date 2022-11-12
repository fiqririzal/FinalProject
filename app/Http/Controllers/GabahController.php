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
        return apiResponse(200, 'success', 'Gabah semua data', Gabah::get());
    }

    public function show($id)
    {
        return apiResponse(200, 'success', 'Gabah show data', Gabah::where('id', $id)->get());
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
                $pleaseRemove = base_path('public/images/gabah').$fileName;

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

            $gabah = Gabah::where('id', $id)->get();

            return apiResponse(202, 'success', 'Gabah berhasil disunting', $gabah);
        } catch (Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }

    public function destroy($id)
    {
        try {
            Gabah::where('id', $id)->delete();
            return apiResponse(202, 'success', 'Gabah berhasil dihapus');
        } catch (Exception $e) {
            return apiResponse(400, 'gagal', 'error', $e);
        }
    }
}
