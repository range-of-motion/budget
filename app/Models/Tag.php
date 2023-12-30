<?php

namespace App\Models;

use App\Events\TagCreated;
use App\Events\TagDeleted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['space_id', 'name', 'color'];

    protected $dispatchesEvents = [
        'created' => TagCreated::class,
        'deleted' => TagDeleted::class
    ];

    // Relations
    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }

    public function spendings()
    {
        return $this->hasMany(Spending::class);
    }

    // Custom
    private static function randomColorPart()
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    public static function randomColor()
    {
        return self::randomColorPart() . self::randomColorPart() . self::randomColorPart();
    }
}
