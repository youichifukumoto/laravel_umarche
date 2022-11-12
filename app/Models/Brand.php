<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Owner;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'brand_name',
        'information',
        'filename',
        'is_selling',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}
