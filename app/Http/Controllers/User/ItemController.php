<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Stripe\Product as StripeProduct;

class ItemController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth:users');

        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameter('item'); //imageのid取得
            if (!is_null($id)) { // null判定
                $itemId = Product::availableItems()->where('products.id', $id)->exists();
                if (!$itemId) { // 同じでなかったら
                    abort(404); // 404画面表示 }
                }
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $products = Product::availableItems()
        ->sortOrder($request->sort)
        ->paginate($request->pagination);

        // $products = Product::all();
        return view('user.index', compact('products'));
    }

    public function show($id)
    {
       $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)             //指定した商品の在庫の在庫を指定して在庫数を$quantityに代入
        ->sum('quantity');

        if ($quantity > 20) {                                        //数量のセレクトボックスの上限をここで指定できる
            $quantity = 20;
        }


       return view('user.show', compact('product', 'quantity'));
    }
}
