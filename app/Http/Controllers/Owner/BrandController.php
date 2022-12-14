<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        //URLのIDを直接変更されて他のメーカー情報を見られない様にする処理
        $this->middleware(function($request, $next){
          $id = $request->route()->parameter('brand'); //ブランドのid取得
          if(!is_null($id)){ // null判定
          $brandsOwnerId = Brand::findOrFail($id)->owner->id;
             $brandId = (int)$brandsOwnerId; // キャスト 文字列→数値に型変換 $ownerId = Auth::id();
             $ownerId = Auth::id();
             if($brandId !== $ownerId){ // 同じでなかったら
               abort(404); // 404画面表示 }
             }
        }
        return $next($request);
        });
    }

    public function index()
    {
        //   $ownerId = Auth::id();
          $brands = Brand::where('owner_id', Auth::id())->get();

          return view('owner.brands.index', compact('brands'));
    }


    public function edit($id)
    {
        $brand = brand::findOrFail($id);
        return view('owner.brands.edit', compact('brand'));
    }

    public function update(UploadImageRequest $request, $id)
    {
        $request->validate([
            'brand_name' => ['required', 'string', 'max:50'],
            'information' => ['string',  'max:1000'],
            'is_selling' => ['required'],
        ]);

        //画像のアップロード処理
        $imageFile = $request->image; //一時保存
        if(!is_null($imageFile) && $imageFile->isValid() ){

            $fileNameToStore = ImageService::upload_brand_image($imageFile, 'brands');//app/Servicesの中に処理内容は入っている。バリデーション済み

            //(画像をリサイズしない時は下の一行のコードを使う)
                         // Storage::putFile('public/brands', $imageFile); //リサイズ無しの場合

            //(app\services\imageService.phpに下記は移動)
                        // $fileName = uniqid(rand().'_');
                        // $extension = $imageFile->extension();
                        // $fileNameToStore = $fileName . '.' . $extension;
                        // $resizedImage = InterventionImage::make($imageFile)->resize(1920, 1080)->encode();

            // Storage::put('public/brands/' . $fileNameToStore, $resizedImage);
        }
        $brand = Brand::findOrFail($id);
        $brand->brand_name = $request->brand_name;
        $brand->information = $request->information;
        $brand->is_selling = $request->is_selling;
        if
        (!is_null($imageFile) && $imageFile->isValid()){
            $brand->filename = $fileNameToStore;
        }

        $brand->save();

        return redirect()->route('owner.brands.index')
        ->with([
            'message' => 'ブランド情報を更新しました。',
            'status' => 'info'
        ]);
    }
}
