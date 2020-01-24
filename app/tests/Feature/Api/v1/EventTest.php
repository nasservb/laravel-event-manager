<?php

namespace Tests\Feature\Api\v1;

use App\Models\Basket;
use App\Models\Event;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Setting;
use App\Models\User;

use http\Message;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * test event functionality
 * Class EventTest
 * @package Tests\Feature\Api\v1
 */
class EventTest extends TestCase
{
    /**
     * structure test for event.
     *
     * @return void
     */
    public function testEventListStructure()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->get('/api/v1/event/');


        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data'=>[

                '*'=> [
                    'id',
                    'name',
                    ],

            ],
            'links' => [
                'first',
                'last',
                'next',
                'prev',
            ],
            'meta' => [
                'current_page',
                'from',
                'last_page',
                'path',
                'per_page',
                'to',
                'total',
            ],
        ]);

    }

    /**
     * test the content of Event api
     */
    public function testCartContent()
    {
        $user = factory(User::class)->create();


        $baskets=[];

        $events = factory(Event::class,10)->create()->each(
            function(Event $event)use ($user){
                $event->user_id= $user->id;
            });



        $response = $this
            ->actingAs($user)
            ->get('/api/v1/event');

        $response->assertStatus(200);
        $response->assertJson([
            'data'=>[
                array_map(function (Event $event) {
                    return [
                        'id'=>$event->id,
                        'title'=>$event->title,
                    ];
                }, $events)
            ]
        ]);



    }

    /**
     * return 404 when set invalid Event id
     */
    public function testError404OnInvalidEventId()
    {
        $user = factory(\App\User::class)->create();

        $response = $this
            ->actingAs($user)
            ->postJson('/api/v1/event/0');

        $response->assertStatus(404);

    }

    /**
     * create event api test
     */
    public function testCreateEvent()
    {
        $user = factory(User::class)->create();


        $response = $this
            ->actingAs($user)
            ->postJson('/api/v1/event/create', [
                'title'=>'test',
                'description'=>'test description'
            ]);

        $response->assertStatus(201);

        $insertedRow = Event::where('user_id',$user->id)->latest()->first();

        $this->assertNotNull($insertedRow);
        $this->assertEquals('test',$insertedRow->title);

    }

    /**
     * view event api test
     */
    public function  testViewEvent()
    {

        $user = factory(User::class)->create();


        $data = factory(Event::class)->create([
            'title'=> 'test',
            'user_id'=> $user->id,
            'description'=>'test description',
            'date'=>now()
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/api/v1/event/'. $data->id );

        $response->assertStatus(200);

        $insertedRow = Event::where('user_id',$user->id)->latest()->first();

        $response->assertJson([
            'data'=>[
                'id'=>$insertedRow->id,
                'title'=>$insertedRow->title,
                'description'=>$insertedRow->description,
                'date'=>$insertedRow->date,
            ]
        ]);


    }


    /**
     * @dataProvider validationDataProvider
     */
    public function testValidation(array $invalidData, string $invalidParameter)
    {

        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->postJson('/api/v1/event/create', $invalidData);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors([$invalidParameter]);
    }


    /**
     * generate data for test validation
     * @return array
     */
    public function validationDataProvider()
    {
        return [
            [['title' => ''], 'title'],
            [['title' => '12345'], 'title'],
            [['title' => $this->generateRandomString(260)], 'title'],
            [['title' => []], 'title'],
            [['title' => [null]], 'title'],
            [['description' => ''], 'description'],
            [['description' => '12345'], 'description'],
            [['description' => $this->generateRandomString(5000)], 'description'],
            [['description' => []], 'description'],
            [['description' => [null]], 'description'],

        ];
    }

    /**
     * generate Random String
     * @param int $length
     * @return string
     */
    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
