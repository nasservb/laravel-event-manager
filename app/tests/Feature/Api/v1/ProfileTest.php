<?php

namespace Tests\Feature\Api\v1;

use App\Models\Business;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{

    /**
     * structure test for get profile.
     *
     * @return void
     */
    public function testGetProfileStructure()
    {
        //prepare data
        $user =  factory(User::class)->create();

        //run api
        $response = $this
            ->actingAs($user )
            ->get('/api/v1/profile/' );

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data'=>[
                    'id',
                    'name',
                    'family',
                    'company_name',
                    'mobile',
                    'website',
                    'email',
                    'avatar_url',
                ],
        ]);


    }

    /**
     * @dataProvider validationDataProvider
     */
    public function testValidation(array $invalidData, string $invalidParameter)
    {

        $user = factory(User::class)->create();


        $validData = [
            'first_name'=>'nasser',
            'last_name'=>'niazy',
            'postal_code'=>'12345',
            'address'=>'tehran/iran',
            'location_latitude'=>38.074109026550595,
            'location_longitude'=>46.296215057373054,
            'company_name'=>'arnikup',
            'mobile'=>'09189151266',
            'website'=>'http://arnikup.com',
        ];
        $data = array_merge($validData, $invalidData);

        $response = $this
            ->actingAs($user)
            ->postJson('/api/v1/profile/', $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([$invalidParameter]);

    }

    public function validationDataProvider()
    {
        return [
            [['first_name' => null], 'first_name'],
            [['first_name' => ''], 'first_name'],
            [['first_name' => []], 'first_name'],

            [['last_name' => null], 'last_name'],
            [['last_name' => 'a'], 'last_name'],
            [['last_name' => ''], 'last_name'],
            [['last_name' => []], 'last_name'],

            [['postal_code' => null], 'postal_code'],
            [['postal_code' => -1], 'postal_code'],
            [['postal_code' => 'dsg'], 'postal_code'],
            [['postal_code' => ''], 'postal_code'],
            [['postal_code' => []], 'postal_code'],

            [['address' => null], 'address'],
            [['address' => -1], 'address'],
            [['address' => 'dsg'], 'address'],
            [['address' => ''], 'address'],
            [['address' => []], 'address'],

            [['mobile' => null], 'mobile'],
            [['mobile' => -1], 'mobile'],
            [['mobile' => 'dsg'], 'mobile'],
            [['mobile' => ''], 'mobile'],
            [['mobile' => 435], 'mobile'],
            [['mobile' => []], 'mobile'],

            [['mobile' => null], 'mobile'],
            [['mobile' => -1], 'mobile'],
            [['mobile' => 'dsg'], 'mobile'],
            [['mobile' => ''], 'mobile'],
            [['mobile' => []], 'mobile'],

        ];
    }

}
