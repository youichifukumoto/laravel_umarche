<?php

namespace App\Services;
use App\Models\Product;
use App\Models\Cart;

class CartService
{
    public static function getItemsInCart($items)
    {
        $products = [];

        foreach($items as $item)
        {
            $p = Product::findOrFail($item->product_id);
            $owner = $p->brand->owner; //オーナー情報
            $ownerInfo = [
                'ownerName' => $owner->name,
                'email'=> $owner->email
            ];

            $brand = $p->brand->select('brand_name')->first()->toArray(); //ブランド情報

            $product = Product::where('id', $item->product_id)->select('id','number', 'name', 'price')->get()->toArray(); // 商品情報の配列
            $quantity = Cart::where('product_id', $item->product_id)->select('quantity')->get()->toArray(); // 在庫数の配列

            $result = array_merge($ownerInfo, $brand, $product[0], $quantity[0]); // 配列の結合

            array_push($products, $result); //配列に追加
        }
        // dd($products);

        return $products;
    }
}
