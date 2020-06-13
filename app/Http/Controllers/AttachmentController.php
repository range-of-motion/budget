<?php

namespace App\Http\Controllers;

use App\Repositories\AttachmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        $fileName = Str::random(20) . '.' . $request->file('file')->extension();
        $filePath = $request->file('file')->storeAs('attachments', $fileName);

        $transactionType = $request->transaction_type;
        $transactionId = $request->transaction_id;

        $this->attachmentRepository->create($transactionType, $transactionId, $filePath);

        return redirect('/' . $transactionType . 's/' . $transactionId);
    }
}
