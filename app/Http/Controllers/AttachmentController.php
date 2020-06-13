<?php

namespace App\Http\Controllers;

use App\Repositories\AttachmentRepository;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    private $attachmentRepository;

    public function __construct(AttachmentRepository $attachmentRepository)
    {
        $this->attachmentRepository = $attachmentRepository;
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_type' => 'required|in:earning,spending',
            'transaction_id' => 'required',
            'file' => 'required|mimes:jpeg,png,pdf'
        ]);

        $transactionType = $request->transaction_type;
        $transactionId = $request->transaction_id;

        $this->attachmentRepository->create($transactionType, $transactionId);

        return redirect('/' . $transactionType . 's/' . $transactionId);
    }
}
