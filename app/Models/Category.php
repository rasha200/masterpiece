<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded  = [];

    public function products(){
    return $this->hasMany(Product::class);
    }

protected static function booted()
    {
        static::deleting(function ($category) {
            // If the category is being soft-deleted, also soft delete related products
            if ($category->isForceDeleting()) {
                // Force delete related products
                $category->products()->forceDelete();
            } else {
                // Soft delete related products
                $category->products()->delete();
            }
        });
    }
}
