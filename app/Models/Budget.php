<?php

namespace App\Models;

use App\Helper;
use App\Repositories\BudgetRepository;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'space_id',
        'tag_id',
        'period',
        'amount',
        'starts_on'
    ];

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    // Accessors
    protected function formattedAmount(): Attribute
    {
        return Attribute::make(fn () => Helper::formatNumber($this->amount / 100));
    }

    protected function spent(): Attribute
    {
        return Attribute::make(fn () => (new BudgetRepository())->getSpentById($this->id));
    }

    protected function formattedSpent(): Attribute
    {
        return Attribute::make(fn () => Helper::formatNumber($this->spent / 100));
    }
}
