<?php

namespace App\Models;

use App\Helper;
use App\Repositories\BudgetRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use SoftDeletes;

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    // Accessors
    public function getFormattedAmountAttribute()
    {
        return Helper::formatNumber($this->amount / 100);
    }

    public function getSpentAttribute()
    {
        return (new BudgetRepository())->getSpentById($this->id);
    }

    public function getFormattedSpentAttribute()
    {
        return Helper::formatNumber($this->spent / 100);
    }
}
