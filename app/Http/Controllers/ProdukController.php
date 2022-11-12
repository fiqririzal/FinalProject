<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index()
    {
        $data = Produk::get();
        foreach($data as $datas)
        {
            $datas->image = asset('/images/produk/' .$datas->image);
        }
        return apiResponse(200, 'success', 'Produk semua data', $data);
    }

    public function show($id)
    {
        $data = Produk::where('id', $id)->first();
        $data->image = asset('/images/produk/' .$data->image);
        return apiResponse(200, 'success', 'Produk show data', $data);
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

            $produk = Produk::create([
                'id_toko' => $request->id_toko,
                'name'    => $request->name,
                'detail'  => $request->detail,
                'price'   => $request->price,
                'image'   => $image,
                'stok'    => $request->stok,
            ]);

            $produk->image = asset('/images/produk/' .$produk->image);

            return apiResponse(201, 'success', 'Produk berhasil ditambah', $produk);
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
                $pleaseRemove = base_path('public/images/produk/').$fileName;

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
            $produk->image = asset('/images/toko/' .$produk->image);

            return apiResponse(202, 'success', 'Produk berhasil disunting', $produk);
        } catch (Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }

    public function destroy($id)
    {
        try {

            $fileName = Produk::where('id', $id)->first()->image;
                $pleaseRemove = base_path('public/images/produk/').$fileName;

            if(file_exists($pleaseRemove)) {
                unlink($pleaseRemove);
            }

            Produk::where('id', $id)->delete();
            return apiResponse(202, 'success', 'Produk berhasil dihapus');
        } catch (Exception $e) {
            return apiResponse(400, 'gagal', 'error', $e);
        }
    }
}
