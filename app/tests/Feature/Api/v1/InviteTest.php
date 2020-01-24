<?php

namespace Tests\Feature\Api\v1;


use App\Http\Resources\InviteViewResource;
use App\Models\Event;
use App\Models\Invite;
use App\Models\User;
use Tests\TestCase;

/**
 * check invite api functionality
 * Class InviteTest
 * @package Tests\Feature\Api\v1
 */
class InviteTest extends TestCase
{

    /**
     * structure test for invite view.
     *
     * @return void
     */
    public function testInviteViewStructure()
    {
        $senderUser = factory(User::class)->create();

        $event = factory(Event::class)->create([
            'title'=>'test',
            'description'=>'teste',
            'user_id'=>$senderUser->id,
        ]);

        $receiverUser = factory(User::class)->create();

        $response = $this
            ->actingAs($senderUser)
            ->post('/api/v1/invite/'.$event->id . '/send',[
                'email'=>$receiverUser->email
                ]);

        $response->assertStatus(200);


        $response = $this
            ->actingAs($senderUser)
            ->get('/api/v1/invite/');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data'=>[
                '*' =>
                    [
                        'id',
                        'receiver_name',
                        'receiver_family',
                        'send_status',
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

        $invite = Invite::where('receiver_user_id', $receiverUser->id)->first();

        $response = $this
            ->actingAs($senderUser)
            ->get('/api/v1/invite/'.$invite->id . '/view');

        $response->assertJson((new InviteViewResource($invite))->toArray(request()));

    }

    /**
     * test send invite to user check
     *
     * @return void
     */
    public function  testSendInvite()
    {

        $senderUser = factory(User::class)->create();

        $event = factory(Event::class)->create([
            'title'=>'test',
            'description'=>'teste',
            'user_id'=>$senderUser->id,
        ]);

        $receiverUser = factory(User::class)->create();

        $response = $this
            ->actingAs($senderUser)
            ->post('/api/v1/invite/'.$event->id . '/send',[
                'email'=>$receiverUser->email
            ]);

        $response->assertStatus(200);

        $invite = Invite::where([
            ['event_id', $event->id],
            ['sender_user_id', $senderUser->id],
            ['receiver_user_id', $receiverUser->id]
        ])->first();

        $this->assertNotNull($invite);

    }

    /**
     * structure test for accept  invite.
     *
     * @return void
     */
    public function testInviteAccept()
    {
        $senderUser = factory(User::class)->create();

        $event = factory(Event::class)->create([
            'title'=>'test',
            'description'=>'teste',
            'user_id'=>$senderUser->id,
        ]);

        $receiverUser = factory(User::class)->create();

        $response = $this
            ->actingAs($senderUser)
            ->post('/api/v1/invite/'.$event->id . '/send',[
                'email'=>$receiverUser->email
            ]);

        $response->assertStatus(200);

        $invite = Invite::where([
                ['event_id', $event->id],
                ['sender_user_id', $senderUser->id],
                ['receiver_user_id', $receiverUser->id]
        ])->first();


        $response = $this
            ->actingAs($senderUser)
            ->post('/api/v1/invite/'.$invite->id . '/accept',[
                'accept'=>'yes'
            ]);

        $response->assertStatus(200);


        $invite = Invite::where([
            ['event_id', $event->id],
            ['sender_user_id', $senderUser->id],
            ['receiver_user_id', $receiverUser->id]
        ])->first();

        $this->assertEquals('yes',$invite->is_accept);

    }



    /**
     * return 404 when set invalid Invite id
     */
    public function testError404OnInvalidInviteId()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->get('/api/v1/invite/0/view');

        $response->assertStatus(404);

    }


}
