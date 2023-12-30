<?php

namespace App\Models;

use App\Events\TransactionCreated;
use App\Events\TransactionDeleted;
use App\Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spending extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'space_id',
        'import_id',
        'recurring_id',
        'tag_id',
        'happened_on',
        'description',
        'amount'
    ];

    protected $dispatchesEvents = [
        'created' => TransactionCreated::class,
        'deleted' => TransactionDeleted::class
    ];

    // Accessors
    protected function formattedAmount(): Attribute
    {
        return Attribute::make(fn () => Helper::formatNumber($this->amount / 100));
    }

    protected function formattedHappenedOn(): Attribute
    {
        return Attribute::make(fn () => Carbon::now()->diffInDays(Carbon::parse($this->happened_on)) . ' days ago');
    }

    // Relations
    public function import()
    {
        return $this->belongsTo(Import::class);
    }

    public function recurring()
    {
        return $this->belongsTo(Recurring::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'transaction_id')
            ->where('transaction_type', 'spending');
    }
}
