<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToAdoupt extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded  = [];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
     }

}
