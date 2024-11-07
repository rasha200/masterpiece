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

     protected static function booted()
    {
        static::saved(function ($toAdoupt) {
            $toAdoupt->updatePetAdoptionStatus();
        });

    }

    

    public function updatePetAdoptionStatus()
    {
        $pet = $this->pet;

        if ($pet) {
            // Set `is_adopted` based on the single adoption request's status
            if ($this->status == 'Accept') {
                $pet->is_adopted = 'Adopted';
            } elseif ($this->status == 'Pending') {
                $pet->is_adopted = 'Pending';
            } else {
                $pet->is_adopted = 'Available';
            }

            $pet->save();
        }
    }
}


