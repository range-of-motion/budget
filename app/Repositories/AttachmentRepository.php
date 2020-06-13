<?php

namespace App\Repositories;

use App\Models\Attachment;
use Exception;

class AttachmentRepository
{
    public function create(string $transactionType, int $transactionId): Attachment
    {
        if ($transactionType !== 'earning' && $transactionType !== 'spending') {
            throw new Exception('Invalid transaction type ("' . $transactionType . '")');
        }

        return Attachment::create([
            'transaction_type' => $transactionType,
            'transaction_id' => $transactionId,
            'file_path' => 'https://via.placeholder.com/500'
        ]);
    }
}
