<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded  = [];

 public function category()
 {
    return $this->belongsTo(Category::class);
 }

 public function product_images()
{
    return $this->hasMany(ProductImage::class);
}


public function product_variation()
{
    return $this->hasMany(ProductVariation::class);
}

 public function product_feedbacks()
{
    return $this->hasMany(ProductFeedback::class);
}

public function wishList()
{
    return $this->hasMany(WishList::class);
}


protected static function booted()
     {
         static::deleting(function ($product) {
             // If the product is being force-deleted, also force delete related feedback
             if ($product->isForceDeleting()) {
                 // Force delete related product feedback
                 $product->product_feedbacks()->forceDelete();
             } else {
                 // Soft delete related product feedback
                 $product->product_feedbacks()->delete();
             }
         });
     }

}
