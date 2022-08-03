<?php

namespace Tests\Feature;

use App\Facades\CompressorFacade;
use App\Jobs\CompressFileJob;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CompressorTest extends TestCase
{
    public function testCompress()
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->create('document.pdf', 2048, 'pdf');

        $test = $file->move(Storage::disk('public')->path('upload'), $file->getClientOriginalName());
        CompressFileJob::dispatch($test->getRealPath());

        $name = File::name($test->getRealPath());
        $exist = Storage::disk('public')->exists("upload/{$name}" . '.' . config('compressor.type'));
        $this->assertTrue($exist);
    }

    public function testNotExistFile()
    {
        $filePath = 'wrong/file/path';
        try {
            CompressorFacade::compress($filePath);
        } catch (\Exception $e) {
            $this->assertEquals("The file does not exists!", $e->getMessage());
        }
    }

    public function testFileSizeIsOver()
    {
        try {
            Storage::fake('public');

            $file = UploadedFile::fake()->create('document.pdf', 2048, 'pdf');
            $test = $file->move(Storage::disk('public')->path('upload'), $file->getClientOriginalName());

            CompressorFacade::compress($test->getRealPath());

            $this->fail('The file is over than the limit!');

        } catch (\Exception $e) {
            $this->assertEquals("The file is over than the limit!", $e->getMessage());
        }
    }

    public function testErrorInCompress()
    {
        try {
            Storage::fake('public');

            $file = UploadedFile::fake()->create('document.pdf', 2048, 'pdf');
            $test = $file->move(Storage::disk('public')->path('upload'), $file->getClientOriginalName());

            CompressorFacade::compress($test->getRealPath());

            $this->fail('Some error in compress file!');

        } catch (\Exception $e) {
            $this->assertEquals("Some error in compress file!", $e->getMessage());
        }
    }

}
