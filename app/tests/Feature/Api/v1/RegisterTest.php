<?php

namespace Tests\Feature\Api\v1;

use App\Models\User;
use Illuminate\Foundation\Testing\TestResponse;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    /**
     * structure test for register.
     *
     * @return void
     */
    public function testStructure()
    {
        User::where('email', 'test@test.com')->delete();

        $response = $this
            ->postJson('/api/v1/auth/register',[
                'name'=>'test name',
                'family'=>'test name',
                'mobile'=>'09189151266',
                'email'=>'test@test.com',
                'password'=>'test pass',
                'device_id'=>'546544453453f3f',
            ]);


        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data'=>[
                'id',
                'name',
                'family',
                'avatar_url',
                'api_token',
            ]
        ]);

    }



    /**
     * test login with invalid data.
     *
     * @return void
     */
    public function testRegisterDenyWithInvalidData()
    {

        $response = $this
            ->postJson('/api/v1/auth/register', [
                'name'=>'test',
                'oauth_id'=>'sd3f3f',
            ]);

        $response->assertStatus(422);
    }

}
