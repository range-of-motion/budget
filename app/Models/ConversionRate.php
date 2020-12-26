<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversionRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'base_currency_id',
        'target_currency_id',
        'rate'
    ];

    public function base()
    {
        return $this->belongsTo(Currency::class);
    }

    public function target()
    {
        return $this->belongsTo(Currency::class);
    }
}
