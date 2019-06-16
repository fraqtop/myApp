<?php

namespace Tests\Unit;

use App\Services\FileService;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class ManageFileTest extends TestCase
{

    /**
     * @var FileService $service
     */

    private $service;

    /**
     * @var FilesystemAdapter
     */

    private $disk;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new FileService();
        $this->disk = Storage::disk('local');
    }

    public function testUploadFile()
    {
        $fileName = 'image.jpg';
        $fakeImage = UploadedFile::fake()->image($fileName);
        $path = $this->service->save($fakeImage, 'local', $fileName);
        $this->disk->assertExists($fileName);
        return $path;
    }

    /**
     * @depends testUploadFile
     * @var string $fileName
     */
    public function testDeleteFile(string $fileName)
    {
        $this->service->remove($fileName);
        $this->service->remove('qweqweqwe');
        $this->disk->assertMissing($fileName);
    }
}
