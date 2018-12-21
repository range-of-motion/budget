<?php

namespace App;

use App\Events\TagCreated;
use App\Events\TagDeleted;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model {
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['space_id', 'name', 'color'];

    protected $dispatchesEvents = [
        'created' => TagCreated::class,
        'deleted' => TagDeleted::class
    ];

    // Relations
    public function spendings() {
        return $this->hasMany(Spending::class);
    }

    // Custom
    private static function randomColorPart() {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    public static function randomColor() {
        return self::randomColorPart() . self::randomColorPart() . self::randomColorPart();
    }
}
