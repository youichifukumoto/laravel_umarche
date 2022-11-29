<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\SecondaryCategory;
use App\Models\Image;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'number',
        'name',
        'information',
        'price',
        'is_selling',
        'sort_order',
        'secondary_category_id',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'image6',
        'image7',
        'image8',
        'image9',
        'image10',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(SecondaryCategory::class, 'secondary_category_id');
    }

    public function imageFirst()
    {
        return $this->belongsTo(Image::class, 'image1', 'id');
    }
    public function imageSecond()
    {
        return $this->belongsTo(Image::class, 'image2', 'id');
    }
    public function imageThird()
    {
        return $this->belongsTo(Image::class, 'image3', 'id');
    }
    public function imageFourth()
    {
        return $this->belongsTo(Image::class, 'image4', 'id');
    }
    public function imageFifth()
    {
        return $this->belongsTo(Image::class, 'image5', 'id');
    }
    public function imageSixth()
    {
        return $this->belongsTo(Image::class, 'image6', 'id');
    }
    public function imageSeventh()
    {
        return $this->belongsTo(Image::class, 'image7', 'id');
    }
    public function imageEighth()
    {
        return $this->belongsTo(Image::class, 'image8', 'id');
    }
    public function imageNinth()
    {
        return $this->belongsTo(Image::class, 'image9', 'id');
    }
    public function imageTenth()
    {
        return $this->belongsTo(Image::class, 'image10', 'id');
    }

    public function stock()
    {
        return $this->hasMany(stock::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'carts')
            ->withPivot(['id', 'quantity']);
    }



    public function scopeAvailableItems($query)
    {
        $stocks = DB::table('t_stocks')
        ->select(
            'product_id',
            DB::raw('sum(quantity) as quantity'))
        ->groupBy('product_id')
        ->having('quantity', '>=', 1);

       return $query
        ->joinSub($stocks, 'stock', function($join) {
            $join->on('products.id', '=', 'stock.product_id');
        })
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('secondary_categories', 'products.secondary_category_id', '=', 'secondary_categories.id')
        ->join('images as image1', 'products.image1', '=', 'image1.id')
        ->where('brands.is_selling', true)
        ->where('products.is_selling', true)
        ->select(
            'products.id as id',
            'products.name as name',
            'products.price',
            'products.sort_order as sort_order',
            'products.information',
            'secondary_categories.name as category',
            'image1.filename as filename'
        );
    }

    public function scopeSortOrder($query, $sortOrder)
   {
       if($sortOrder === null || $sortOrder === \Constant::SORT_ORDER['recommend']){
        return $query->orderBy('sort_order', 'asc');
     }

      if($sortOrder === \Constant::SORT_ORDER['higherPrice']){
        return $query->orderBy('price', 'desc') ;
     }

     if($sortOrder === \Constant::SORT_ORDER['lowerPrice']){
        return $query->orderBy('price', 'asc') ;
     }

     if($sortOrder === \Constant::SORT_ORDER['later']){
       return $query->orderBy('products.created_at', 'desc');
     }

    if($sortOrder === \Constant::SORT_ORDER['older']){
       return $query->orderBy('products.created_at', 'asc') ;
     }
   }

   public function scopeSelectCategory($query, $categoryId)
   {
       if($categoryId !== '0')
       {
          return $query->where('secondary_category_id', $categoryId);
       } else {
           return;
       }
   }

   public function scopeSearchKeyword($query, $keyword)
   {
       if(!is_null($keyword))
       {
           $spaceConvert = mb_convert_kana($keyword,'s'); //全角スペースを半角に

           $keywords = preg_split('/[\s]+/', $spaceConvert,-1,PREG_SPLIT_NO_EMPTY); //空白で区切る


           foreach($keywords as $word) //単語をループで回す
            {
            $query->where('products.number','like','%'.$word.'%');
            }
            return $query;
       } else {
           return;
       }
   }
}
