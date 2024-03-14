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

    function scopeStatus (Builder $query, Status $status, $column = 'status') {
        $query->where($column, $status);
    }

    function scopeIsActive (Builder $query, $column = 'status') {
        $query->where($column, Status::ACTIVE);
    }

    function scopeIsInActive (Builder $query, $column = 'status') {
        $query->where($column, Status::INACTIVE);
    }

    function scopeIsDelayed (Builder $query, $column = 'status') {
        $query->where($column, Status::DELAYED);
    }

    function getActiveAttribute(){
        return $this->status == Status::ACTIVE;
    }

    function getInActiveAttribute(){
        return $this->status == Status::INACTIVE;
    }

    function getDelayedAttribute(){
        return $this->status == Status::DELAYED;
    }

}
