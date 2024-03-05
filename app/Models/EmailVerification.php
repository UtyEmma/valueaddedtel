<?php

namespace App\Models;

use App\Enums\Status;
use App\Mailables\EmailVerificationMessage;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

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



}
