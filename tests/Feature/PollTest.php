<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Poll;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Livewire\Livewire;
use App\Livewire\Admin\PollCreate;
use App\Livewire\Public\PollView;

class PollTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_poll()
    {
        $admin = Admin::factory()->create();

        Livewire::actingAs($admin, 'admin')
            ->test(PollCreate::class)
            ->set('question', 'Favorite Language?')
            ->set('options', ['PHP', 'JS'])
            ->call('save');

        $this->assertDatabaseHas('polls', ['question' => 'Favorite Language?']);
    }

    public function test_guest_can_vote()
    {
        $admin = Admin::factory()->create();
        $poll = Poll::create(['question' => 'Pick one', 'slug' => 'pick-one', 'created_by' => $admin->id]);
        $poll->options()->create(['option_text' => 'Option 1']);

        Livewire::test(PollView::class, ['slug' => 'pick-one'])
            ->set('selectedOption', $poll->options->first()->id)
            ->call('vote');

        $this->assertDatabaseHas('votes', ['poll_id' => $poll->id]);
    }

    public function test_guest_cannot_vote_twice_using_same_ip()
    {
        $admin = Admin::factory()->create();
        $poll = Poll::create(['question' => 'Pick one', 'slug' => 'pick-one', 'created_by' => $admin->id]);
        $option = $poll->options()->create(['option_text' => 'Option 1']);

        // First vote
        Livewire::test(PollView::class, ['slug' => 'pick-one'])
            ->set('selectedOption', $option->id)
            ->call('vote');

        // Second vote same IP (default testing IP)
        Livewire::test(PollView::class, ['slug' => 'pick-one'])
            ->set('selectedOption', $option->id)
            ->call('vote');

        $this->assertEquals(1, $poll->votes()->count());
    }

    public function test_user_cannot_vote_twice_using_same_user_id()
    {
        $user = User::factory()->create();
        $admin = Admin::factory()->create();
        $poll = Poll::create(['question' => 'Pick one', 'slug' => 'pick-one', 'created_by' => $admin->id]);
        $option = $poll->options()->create(['option_text' => 'Option 1']);

        // First vote
        Livewire::actingAs($user)
            ->test(PollView::class, ['slug' => 'pick-one'])
            ->set('selectedOption', $option->id)
            ->call('vote');

        // Second vote
        Livewire::actingAs($user)
            ->test(PollView::class, ['slug' => 'pick-one'])
            ->set('selectedOption', $option->id)
            ->call('vote');

        $this->assertEquals(1, $poll->votes()->where('user_id', $user->id)->count());
    }
}
