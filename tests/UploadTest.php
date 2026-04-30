<?php

use PHPUnit\Framework\TestCase;
use App\Utility\Upload;

class UploadTest extends TestCase
{
    public function testUploadWithoutFileThrowsException()
    {
        $this->expectException(\Throwable::class);

        Upload::uploadFile([], '/tmp');
    }

    public function testUploadWithUploadErrorThrowsException()
    {
        $this->expectException(\Throwable::class);

        $file = [
            'name' => 'test.jpg',
            'tmp_name' => '',
            'error' => UPLOAD_ERR_NO_FILE,
            'size' => 0,
            'type' => 'image/jpeg'
        ];

        Upload::uploadFile($file, '/tmp');
    }

    public function testUploadRejectsInvalidFileType()
    {
        $this->expectException(\Throwable::class);

        $file = [
            'name' => 'test.txt',
            'tmp_name' => __FILE__,
            'error' => UPLOAD_ERR_OK,
            'size' => 100,
            'type' => 'text/plain'
        ];

        Upload::uploadFile($file, '/tmp');
    }
}
