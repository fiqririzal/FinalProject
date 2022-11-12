<?php

namespace App\Http\Controllers;

use Exception;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index()
    {
        return apiResponse(200, 'success', 'Produk semua data', Produk::get());
    }

    public function show($id)
    {
        return apiResponse(200, 'success', 'Produk show data', Produk::where('id', $id)->get());
    }

    public function store(Request $request){

        $rules = [
            'id_toko' => 'required',
            'name'    => 'required',
            'detail'  => 'required',
            'price'   => 'required',
            'image'   => 'required',
            'stok'    => 'required',
        ];
        $message = [
            'id_toko.required' => 'mohon isikan id toko nya bro',
            'name.required'    => 'mohon isikan nama nya bro',
            'detail.required'  => 'mohon isikan detail nya bro',
            'price.required'   => 'mohon isikan harga nya bro',
            'image.required'   => 'mohon isikan gambar nya bro',
            'stok.required'    => 'mohon isikan stok nya bro',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return apiResponse(400, 'error', 'Data tidak lengkap ', $validator->errors());
        }
        try{
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = strtotime(date('Y-m-d H:i:s')).'.'.$extension;
            $destination = base_path('public/images/produk');
            $request->file('image')->move($destination,$image);

            $gabah = Produk::create([
                'id_toko' => $request->id_toko,
                'name'    => $request->name,
                'detail'  => $request->detail,
                'price'   => $request->price,
                'image'   => $image,
                'stok'    => $request->stok,
            ]);

            return apiResponse(201, 'success', 'Produk berhasil ditambah', $gabah);
        } catch(Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'id_toko' => 'required',
            'name'    => 'required',
            'detail'  => 'required',
            'price'   => 'required',
            'image'   => 'required',
            'stok'    => 'required',
        ];
        $message = [
            'id_toko.required' => 'mohon isikan id toko nya bro',
            'name.required'    => 'mohon isikan nama nya bro',
            'detail.required'  => 'mohon isikan detail nya bro',
            'price.required'   => 'mohon isikan harga nya bro',
            'image.required'   => 'mohon isikan gambar nya bro',
            'stok.required'    => 'mohon isikan stok nya bro',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return apiResponse(400, 'error', 'Data tidak lengkap ', $validator->errors());
        }
        try{
            $fileName = Produk::where('id', $id)->first()->image;

            if($fileName)
            {
                $pleaseRemove = base_path('public/images/produk').$fileName;

                if(file_exists($pleaseRemove)) {
                    unlink($pleaseRemove);
                }
            }

            $extension = $request->file('image')->getClientOriginalExtension();
            $image = strtotime(date('Y-m-d H:i:s')).'.'.$extension;
            $destination = base_path('public/images/produk');
            $request->file('image')->move($destination, $image);

            Produk::where('id', $id)->update([
                'id_toko' => $request->id_toko,
                'name'    => $request->name,
                'detail'  => $request->detail,
                'price'   => $request->price,
                'image'   => $image,
                'stok'    => $request->stok,
            ]);

            $produk = Produk::where('id', $id)->get();

            return apiResponse(202, 'success', 'Produk berhasil disunting', $produk);
        } catch (Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }

    public function destroy($id)
    {
        try {
            Produk::where('id', $id)->delete();
            return apiResponse(202, 'success', 'Produk berhasil dihapus');
        } catch (Exception $e) {
            return apiResponse(400, 'gagal', 'error', $e);
        }
    }
}
