<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_send_message_to_mentor_and_it_increments_unread_count()
    {
        $student = User::factory()->create(['role' => 'user']);
        $mentor = User::factory()->create(['role' => 'mentor']);

        $this->actingAs($student);
        $response = $this->post(route('messages.store', $mentor), ['body' => 'Hello']);
        $response->assertRedirect();
        $this->assertDatabaseHas('messages', [
            'sender_id' => $student->id,
            'receiver_id' => $mentor->id,
            'body' => 'Hello',
            'read' => false,
        ]);

        $this->assertEquals(1, Message::where('receiver_id', $mentor->id)->where('read', false)->count());
    }

    /** @test */
    public function viewing_conversation_marks_messages_as_read()
    {
        $student = User::factory()->create(['role' => 'user']);
        $mentor = User::factory()->create(['role' => 'mentor']);

        Message::create(["sender_id" => $student->id, "receiver_id" => $mentor->id, "body" => "hi", "read" => false]);
        Message::create(["sender_id" => $mentor->id, "receiver_id" => $student->id, "body" => "hey", "read" => false]);

        $this->actingAs($mentor);
        $response = $this->get(route('messages.show', $student));
        if ($response->status() !== 200) {
            // dump content for debugging
            fwrite(STDERR, $response->getContent());
        }
        $response->assertStatus(200);
        $this->assertEquals(0, Message::where('receiver_id', $mentor->id)->where('read', false)->count());
    }
}
