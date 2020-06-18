<?php

namespace App\Repositories;

use App\Models\Attachment;
use Exception;

class AttachmentRepository
{
    public function getById(int $id): ?Attachment
    {
        return Attachment::find($id);
    }

    public function create(string $transactionType, int $transactionId, string $filePath): Attachment
    {
        if ($transactionType !== 'earning' && $transactionType !== 'spending') {
            throw new Exception('Invalid transaction type ("' . $transactionType . '")');
        }

        return Attachment::create([
            'transaction_type' => $transactionType,
            'transaction_id' => $transactionId,
            'file_path' => $filePath
        ]);
    }

    public function delete(int $id): void
    {
        $attachment = $this->getById($id);

        if (!$attachment) {
            throw new Exception('Could not find attachment with ID ' . $id);
        }

        $attachment->delete();
    }
}
