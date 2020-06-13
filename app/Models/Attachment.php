<?php

namespace App\Models;

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

    // Accessors
    public function getFileB64Attribute()
    {
        $file = Storage::get($this->file_path);

        if (!$file) {
            return null;
        }

        $type = pathinfo($this->file_path, PATHINFO_EXTENSION);

        return 'data:image/' . $type . ';base64,' . base64_encode($file);
    }
}
