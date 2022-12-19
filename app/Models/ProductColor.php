<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;

class ProductColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'color',
    ];


    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
