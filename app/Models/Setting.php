<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'slug', 'value'];

    function __get($key) {
        if(property_exists($this, $key)) return $this[$key];
        if($setting = $this->where('slug', $key)->first()) return $setting;
        return parent::__get($key);
    }

    static function retrieve(...$fields) {
        if(!$fields) {
            $data = self::all();
        }else {
            $data = collect($fields)->reduce(fn($carry, $value) => $carry = $carry->orWhere('slug', $value), self::query())->get();
        }

        $arr = collect($data->all())->reduce(fn($carry, $value) => $carry = array_merge($carry, [$value->slug => $value->toArray()]), []);

        return $arr;
    }


}
