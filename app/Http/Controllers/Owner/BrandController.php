<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;

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
        dd(Brand::findOrFail($id));

    }

    public function update(Request $request, $id)
    {

    }
}
