<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['id','name','description','price','quantity'];

    public function featuredImage()
{
    return $this->hasOne(Image::class, 'product_id')->where('type', 'featured_product');
}


}
