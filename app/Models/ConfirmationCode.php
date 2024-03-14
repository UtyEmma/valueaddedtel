<?php

namespace App\Models;

use App\Enums\ConfirmationActions;
use App\Enums\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmationCode extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['user_id', 'action', 'code', 'expires_at', 'status'];

    protected $attribute = [
        'status' => Status::PENDING
    ];

    protected $casts = [
        'status' => Status::class,
        'action' => ConfirmationActions::class
    ];

    function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    function getIsValidAttribute(){
        return now()->lessThanOrEqualTo($this->expires_at);
    }

    function getIsExpiredAttribute(){
        return now()->greaterThan($this->expires_at);
    }

    function getIsUsedAttribute(){
        return $this->status == Status::VERIFIED;
    }

    function getIsUnusedAttribute(){
        return $this->status == Status::PENDING;
    }

}
