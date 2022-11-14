<?php

namespace App\Http\Controllers;

use Exception;
use App\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Redis;

class ArticleController extends Controller
{
    //Create a new Article
    public function store(Request $request){

        $rules = [
            'category' => 'required',
            'title' => 'required',
            'body' => 'required',
            'image' => 'required',
        ];
        $message = [
            'category.required' => 'mohon isikan Category anda',
            'title.required' => 'mohon isikan title nya bro',
            'body.required' => 'mohon isikan detail nya bro',
            'image.required' => 'mohon isikan image nya bro',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return apiResponse(400, 'error', 'Data tidak lengkap ', $validator->errors());
        }try{
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = strtotime(date('Y-m-d H:i:s')).'.'.$extension;
            $destination = base_path('public/images/Article');
            $request->file('image')->move($destination,$image);
            // $image_path = $request->file('image')->store('image', 'public');

               $article = Article::create([
                    'id_category'=>$request->category,
                    'title'=>$request->title,
                    'slug'=>Str::slug($request->title),
                    'body'=>$request->body,
                    'image' => $image,
                ]);
                $article->image = asset('/images/article/' .$article->image);

                return apiResponse(201, 'success', 'berhasil menambah Artikel', $article);
        } catch(Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }
    //show all Article
    public function index(){
        $article = Article::all();

        foreach ($article as $articles){
            $articles->image = asset('/images/Article/' .$articles->image);

        }
        return apiResponse(200, 'success', 'List Article', $article);

    }
    //delete Article
    public function destroy($id){
        {
            try {
                DB::transaction(function () use ($id) {
                    Article::where('id', $id)->delete();
                });
                return apiResponse(202, 'success', 'data berhasil dihapus');
            } catch (Exception $e) {
                return apiResponse(400, 'gagal', 'error', $e);
            }
        }
    }
    public function update(Request $request, $id){
        {
            $rules = [
                'category' => 'required',
                'title' => 'required',
                'body' => 'required',
                'image' => 'required',

            ];
            $message = [
                'category.required' => 'mohon isikan Category anda',
                'title.required' => 'mohon isikan title nya bro',
                'body.required' => 'mohon isikan detail nya bro',
                'image.required' => 'mohon isikan image nya bro',
            ];
            $validator = Validator::make($request->all(), $rules, $message);
            if ($validator->fails()) {
                return apiResponse(400, 'error', 'Data tidak lengkap ', $validator->errors());
            }
            try{
                $fileName = Article::where('id', $id)->first()->image;


                if($fileName)
                {
                    $pleaseRemove = base_path('public/images/Article/').$fileName;

                    if(file_exists($pleaseRemove)) {
                        unlink($pleaseRemove);
                    }
                }

                $extension = $request->file('image')->getClientOriginalExtension();
                $image = strtotime(date('Y-m-d H:i:s')).'.'.$extension;
                $destination = base_path('public/images/Article');
                $request->file('image')->move($destination,$image);

                // DB::transaction(function () use ($request, $id ,$image) {
                    Article::where('id', $id)->update([
                            'id_category'=>$request->category,
                            'title'=>$request->title,
                            'slug'=>Str::slug($request->title),
                            'body' =>$request->body,
                            'image' =>$image,
                            'updated_at' => date('Y-m-d H-i-s')
                        ]);

                return apiResponse(202, 'success', 'user berhasil disunting');
            } catch (Exception $e) {
                if(env('APP_ENV') == 'local') {
                }
                return apiResponse(400, 'error', 'error', $e);
            }
        }
    }
}
