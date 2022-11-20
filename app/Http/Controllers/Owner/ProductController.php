<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use App\Models\product;
use App\Models\Stock;
use App\Models\Brand;
use App\Models\PrimaryCategory;
use App\Models\Owner;
use App\Http\Requests\ProductRequest;



class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        //URLのIDを直接変更されて他のメーカー情報を見られない様にする処理
        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameter('product'); //imageのid取得
            if (!is_null($id)) { // null判定
                $productsOwnerId = Product::findOrFail($id)->brand->owner->id;
                $productId = (int)$productsOwnerId; // キャスト 文字列→数値に型変換 $ownerId = Auth::id();
                if ($productId !== Auth::id()) { // 同じでなかったら
                    abort(404); // 404画面表示 }
                }
            }
            return $next($request);
        });
    }

    public function index()
    {
        // $products = Owner::findOrFail(Auth::id())->brand->product;
        $ownerInfo= owner::with('brand.product.imageFirst')->where('id', Auth::id())->get();

        return view('owner.products.index', compact('ownerInfo'));
    }






    public function create()
    {
        $brands = Brand::where('owner_id', Auth::id())                               //ブランドの外部キー取得
        ->select('id','brand_name')->get();

        $images =  Image::where('owner_id', Auth::id())                              //画像の外部キー取得
        ->select('id', 'title', 'filename')
        ->orderBy('updated_at', 'desc')
        ->get();

        $categories = PrimaryCategory::with('secondary')->get();                     //カテゴリーの外部キー取得

        return view('owner.products.create', compact('brands', 'images', 'categories'));
    }






    public function store(ProductRequest $request)
    {
        try {                                                          //トランザクション処理…商品を登録したらstock（在庫）も生成する。
            DB::transaction(function () use ($request) {
                $product = Product::create([
                    'number' => $request->number,
                    'name' => $request->name,
                    'information' => $request->information,
                    'price' => $request->price,
                    'sort_order' => $request->sort_order,
                    'brand_id' => $request->brand_id,
                    'secondary_category_id' => $request->category,
                    'image1' => $request->image1,
                    'image2' => $request->image2,
                    'image3' => $request->image3,
                    'image4' => $request->image4,
                    'image5' => $request->image5,
                    'image6' => $request->image6,
                    'image7' => $request->image7,
                    'image8' => $request->image8,
                    'image9' => $request->image9,
                    'image10' => $request->image10,
                    'is_selling' => $request->is_selling,
                ]);

                Stock::create([
                    'product_id' => $product->id,
                    'type' => 1,
                    'quantity' => $request->quantity,
                ]);
            }, 2);
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()
            ->route('owner.products.index')
            ->with([
                'message' => '商品登録しました。',
                'status' => 'info'
            ]);
    }





    public function edit($id)
    {

        $product = Product::findOrFail($id);                            //特定の商品を指定する
        $quantity = Stock::where('product_id',$product->id)             //指定した商品の在庫の在庫を指定して在庫数を$quantityに代入
        ->sum('quantity');



        $brands = Brand::where('owner_id', Auth::id())                  //ブランドの外部キー取得
        ->select('id', 'brand_name')->get();

        $images =  Image::where('owner_id', Auth::id())                 //画像の外部キー取得
        ->select('id', 'title', 'filename')
        ->orderBy('updated_at', 'desc')
        ->get();

        $categories = PrimaryCategory::with('secondary')->get();        //カテゴリーの外部キー取得

        return view('owner.products.edit',compact('product', 'quantity', 'brands', 'images', 'categories'));
    }




    public function update(ProductRequest $request, $id)
    {
        $request->validate([
          'current_quantity' => ['required', 'integer'],
        ]);

        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)             //指定した商品の在庫の在庫を指定して在庫数を$quantityに代入
        ->sum('quantity');

        if($request->current_quantity !== $quantity){
            $id = $request->route()->parameter('product'); //imageのid取得
            return redirect()->route('owner.products.edit', ['product' => $id])
            ->with([
                'message' => 'このコミットの途中に在庫数に変更がありました。再度確認をしてください。',
                'status' => 'alert'
            ]);;

        }else{
            try {                                                          //トランザクション処理…商品を登録したらstock（在庫）も生成する。
                DB::transaction(function () use ($request, $product) {
                        $product->number = $request->number;
                        $product->name = $request->name;
                        $product->information = $request->information;
                        $product->price = $request->price;
                        $product->sort_order = $request->sort_order;
                        $product->brand_id = $request->brand_id;
                        $product->secondary_category_id = $request->category;
                        $product->image1 = $request->image1;
                        $product->image2 = $request->image2;
                        $product->image3 = $request->image3;
                        $product->image4 = $request->image4;
                        $product->image5 = $request->image5;
                        $product->image6 = $request->image6;
                        $product->image7 = $request->image7;
                        $product->image8 = $request->image8;
                        $product->image9 = $request->image9;
                        $product->image10 = $request->image10;
                        $product->is_selling = $request->is_selling;
                        $product->save();

                    if($request->type === \Constant::PRODUCT_LIST['add']){
                        $newQuantity = $request->quantity;
                    }
                    if($request->type === \Constant::PRODUCT_LIST['reduce']){
                        $newQuantity = $request->quantity * -1;
                    }
                    Stock::create([
                        'product_id' => $product->id,
                        'type' => $request->type,
                        'quantity' => $newQuantity

                    ]);
                }, 2);
            } catch (Throwable $e) {
                Log::error($e);
                throw $e;
            }

            return redirect()
            ->route('owner.products.index')
            ->with([
                'message' => '商品情報を更新しました。',
                'status' => 'info'
            ]);

        }

    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
