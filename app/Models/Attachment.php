<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'transaction_type',
        'transaction_id',
        'file_path'
    ];

    // Relationships
    public function transaction()
    {
        if ($this->transaction_type === 'earning') {
            return $this->belongsTo(Earning::class, 'transaction_id');
        }

        if ($this->transaction_type) {
            return $this->belongsTo(Spending::class, 'transaction_id');
        }

        throw new Exception('Invalid transaction type for attachment (ID ' . $this->id . ')');
    }

    // Accessors
    protected function fileB64(): Attribute
    {
        return Attribute::make(function () {
            $file = Storage::get($this->file_path);

            if (!$file) {
                return null;
            }

            $type = pathinfo($this->file_path, PATHINFO_EXTENSION);

            return 'data:image/' . $type . ';base64,' . base64_encode($file);
        });
    }

    protected function fileType(): Attribute
    {
        return Attribute::make(function () {
            $parts = explode('.', $this->file_path);

            return $parts[count($parts) - 1];
        });
    }
}
