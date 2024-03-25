<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\V1\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class EventTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    //Test if a event can be deleted (make sure that you add the middleware)
    public function test_delete_event()
    {
        $event = Event::factory()->count(1)->make();

        $event = Event::first();

        if($event) {
            $event->delete();
        }

        $this->assertTrue(true);
    }

    //Perform a post() request to add a new event
    public function test_if_it_stores_new_events()
    {
        $user = User::factory()->create();
        Auth::login($user);
        $response = $this->post('/events', [
            'name' => fake()->name(),
            'available_tickets' => fake()->numberBetween(0, 100),
            'description' => fake()->text(),
            'date' => now(),
        ]);

        $response->assertRedirect('/events');
    }

    public function test_if_seeders_works()
    {
        $this->seed();
    }
}
