<?php

namespace Tests\Unit;

use App\Services\MailService;
use App\Services\UserService;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class MailDeliveryTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * @var MailService
     */
    private $mails;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mails = new MailService(new UserService());
    }

    public function testSuccessDelivery()
    {
        $this->assertTrue($this->mails->send([
            'message' => 'error',
            'file' => '/vendor/laravel/http/handler'
        ]));
    }

    public function testFailedDelivery()
    {
        $this->assertFalse($this->mails->send([
            'type' => 'unhandled type'
        ]));
    }
}
