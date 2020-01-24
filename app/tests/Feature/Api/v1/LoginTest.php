<?php

namespace Tests\Feature\Api\v1;

use App\Models\User;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * structure test for login.
     *
     * @return void
     */
    public function testStructure()
    {
        $testEmail ='fake_'. rand(500,900).'@test.com';
        $testPass ='fake_'. rand(500,900);

        $user = factory(User::class)->create([
            'email'=>$testEmail,
            'password'=>Hash::make($testPass),
            'api_token'=>Hash::make('api-'.$testPass)
        ]);

        $response = $this
            ->postJson('/api/v1/auth/login', [
                'email' => $testEmail,
                'password' => $testPass,
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
     * test for login api.
     *
     * @return void
     */
    public function testLoginWithEmail()
    {
        $testEmail ='fake_'. rand(500,900).'@test.com';
        $testPass ='fake_'. rand(500,900);

        $user = factory(User::class)->create([
            'email'=>$testEmail,
            'password'=>Hash::make($testPass),
            'api_token'=>Hash::make('api-'.$testPass)
            ]);

        $response = $this
            ->postJson('/api/v1/auth/login', [
                'email' => $testEmail,
                'password' => $testPass,
            ]);

        $response->assertStatus(200);
        $id = $response->json('data.id');
        $responseUser = User::find($id);

        $this->assertEquals(Hash::make('api-'.$testPass), $responseUser->api_token);

    }

    /**
     * test login with invalid data.
     *
     * @return void
     */
    public function testLoginDenyWithInvalidData()
    {

        $response = $this
            ->postJson('/api/v1/auth/login', [
                'email' => 'fake@fake.com',
                'password' => '123434345',
            ]);

        $response->assertStatus(403);
    }


}
