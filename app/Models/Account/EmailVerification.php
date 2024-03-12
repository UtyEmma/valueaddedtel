<?php

namespace App\Models\Account;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Illuminate\Events\queueable;

class EmailVerification extends Model {
    use HasFactory, HasUuids;

    protected $fillable = ['user_id', 'code', 'expires_at', 'completed_at', 'status'];

    protected $attributes = [
        'status' => Status::PENDING
    ];

    protected static function booted() {
        static::created(queueable(function($verification){
            // notify(EmailVerificationMessage::class, [
            //     'verification' => $verification,
            //     'user' => $verification->user,
            //     'timeout' => 10,
            //     'code' => $verification->code
            // ])->send($verification->user, ['mail']);
        }));
    }

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
