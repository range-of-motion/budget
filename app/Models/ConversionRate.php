<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversionRate extends Model
{
    public function base()
    {
        return $this->belongsTo(Currency::class);
    }

    public function target()
    {
        return $this->belongsTo(Currency::class);
    }
}
