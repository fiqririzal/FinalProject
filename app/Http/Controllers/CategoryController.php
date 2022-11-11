<?php

namespace App\Http\Controllers;

use Exception;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //create a new category
    public function store(Request $request){
        try{
            DB::transaction(function ()use($request) {
                Category::insertGetId([
                    'name'=>$request->name,
                    'detail'=>$request->detail,
                    'slug'=>Str::slug($request->name),
                    'created_at'=>date('Y-m-d H-i-s')
                ]);

            });
            return apiResponse(201, 'success', 'berhasil menambah data');
        } catch(Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }
    //show All Category
    public function index(){
        {
            $category = Category::all();

            return apiResponse(200, 'success', 'List Kategori', $category);
        }
    }
    //Update Category
    public function update(Request $request, $id){
        {
            $rules = [
                'name' => 'required',
                'detail' => 'required',
            ];
            $message = [
                'name.required' => 'mohon isikan nama anda',
                'detail.required' => 'mohon isikan detail nya bro',
            ];
            $validator = Validator::make($request->all(), $rules, $message);
            if ($validator->fails()) {
                return apiResponse(400, 'error', 'Data tidak lengkap ', $validator->errors());
            }
            try  {
                DB::transaction(function () use ($request, $id) {
                    Category::where('id', $id)->update([
                            'name'=>$request->name,
                            'detail'=>$request->detail,
                            'slug'=>Str::slug($request->name),
                            'updated_at' => date('Y-m-d H-i-s')
                        ]);
                });
                return apiResponse(202, 'success', 'user berhasil disunting');
            } catch (Exception $e) {
                return apiResponse(400, 'error', 'error', $e);
            }
        }
    }
    //delete Category
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                Category::where('id', $id)->delete();
            });
            return apiResponse(202, 'success', 'data berhasil dihapus');
        } catch (Exception $e) {
            return apiResponse(400, 'gagal', 'error', $e);
        }
    }
}
