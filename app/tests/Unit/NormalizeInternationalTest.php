<?php

namespace Tests\Unit;

use App\Helpers\NormalizeHelper;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NormalizeInternationalTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {

        $data = NormalizeHelper::InternationalMobile('09121234567');
        $this->assertEquals('+989121234567', $data);


        $data = NormalizeHelper::InternationalMobile('00989121234567');
        $this->assertEquals('+989121234567', $data);
    }
}
