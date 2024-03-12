<?php

namespace App\Models\Services;

use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory, HasStatus;

    protected $fillable = ['name', 'shortcode', 'status'];

    protected $primary = 'shortcode';
    public $incrementing = false;


}
