<?php

namespace App\Traits;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Builder;

trait HasStatus{

    public function initializeHasStatus(){
        $this->casts['status'] = Status::class;

        $this->attributes['status'] = Status::ACTIVE;

        $this->fillable[] = 'status';

    }

    function scopeStatus (Builder $query, Status $status) {
        $query->where('status', $status);
    }

    function scopeIsActive (Builder $query) {
        $query->where('status', Status::ACTIVE);
    }

    function scopeIsInActive (Builder $query) {
        $query->where('status', Status::INACTIVE);
    }

    function getActiveAttribute(){
        return $this->where('status', Status::ACTIVE)->get();
    }

}
