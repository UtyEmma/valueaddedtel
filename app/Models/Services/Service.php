<?php

namespace App\Models\Services;

use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model {
    use HasFactory, HasStatus, SoftDeletes;

    protected $fillable = ['name', 'shortcode'];

    protected $primary = 'shortcode';
    public $incrementing = false;


}
