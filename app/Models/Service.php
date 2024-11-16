<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded  = [];

    public function service_images()
{
    return $this->hasMany(ServiceImage::class);
}

public function service_feedbacks()
{
    return $this->hasMany(ServiceFeedback::class);
}

public function availability_times()
{
    return $this->hasMany(AvailabilityTime::class);
}

protected static function booted()
     {
         static::deleting(function ($service) {
             // If the service is being force-deleted, also force delete related feedback
             if ($service->isForceDeleting()) {
                 // Force delete related service feedback
                 $service->service_feedbacks()->forceDelete();
             } else {
                 // Soft delete related service feedback
                 $service->service_feedbacks()->delete();
             }
         });
     }


}
