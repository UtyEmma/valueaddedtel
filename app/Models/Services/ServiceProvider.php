<?php

namespace App\Models\Services;

use App\Models\Country;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model {
    use HasFactory, HasUuids, HasStatus;

    protected $fillable = ['name', 'shortcode'];

    protected $primaryKey = 'shortcode';
    public $incrementing = false;
    public $keyType = 'string';

    function countries(){
        // return $this->hasMany(Country::class, )
    }


}
