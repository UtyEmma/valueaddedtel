<?php

namespace App\Models\Services;

use App\Models\Country;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'shortcode', 'status'];

    protected $primaryKey = 'shortcode';
    public $incrementing = false;
    public $keyType = 'string';

    function country(){

    }

    function provider(){
        // return $this->belongsTo(ServiceProvider)
    }

}
