<?php

namespace Tests\Unit\Models;

use App\Repositories\AttachmentRepository;
use Tests\TestCase;

class AttachmentTest extends TestCase
{
    public function testFileTypeAccessor(): void
    {
        $attachmentRepository = new AttachmentRepository();

        $cases = [
            [
                'file_path' => 'grass.png',
                'expected' => 'png'
            ],
            [
                'file_path' => 'water.pdf',
                'expected' => 'pdf'
            ],
            [
                'file_path' => 'night.jpeg',
                'expected' => 'jpeg'
            ]
        ];

        foreach ($cases as $case) {
            $attachment = $attachmentRepository->create('spending', 1, $case['file_path']);

            $this->assertEquals($case['expected'], $attachment->file_type);
        }
    }
}
