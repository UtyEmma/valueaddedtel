<?php

namespace App\Traits;

use App\Enums\Status;
use App\Library\Token;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;

trait VerifyEmail {

    function sendVerificationEmail(){
        $verificationCode = (new Token)->numeric(EmailVerification::class);

        $this->emailVerifications()->create([
            'code' => $verificationCode,
            'expires_at' => now()->addMinutes(10)
        ]);

        $this->emailVerifications()->where('status', Status::PENDING)->update([
            'status' => Status::CANCELLED
        ]);
    }

    function verifyEmail($code){
        if(!$emailVerification = $this->emailVerifications()->where('code', $code)->first()) return [false, 'The Verification code is not correct'];
        if($emailVerification->status == Status::CANCELLED) return [false, 'The Verification code is not valid'];
        if(now()->greaterThan($emailVerification->expires_at)) return [false, 'The Verification code has expired'];

        $emailVerification->status = Status::VERIFIED;
        $emailVerification->save();

        $this->markEmailAsVerified();

        return [true, 'Email Verification Successful'];
    }

    function emailVerifications(){
        return $this->hasMany(EmailVerification::class, 'user_id');
    }



}
