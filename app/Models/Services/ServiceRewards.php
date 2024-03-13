<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRewards extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['service_code', 'comission', 'type', 'accumulated_pv'];

    function service(){
        return $this->belongsTo(Service::class, 'service_code');
    }

}
