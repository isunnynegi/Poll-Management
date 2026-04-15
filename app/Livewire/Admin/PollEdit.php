<?php

namespace App\Livewire\Admin;

use App\Repositories\Interfaces\PollRepositoryInterface;
use App\Services\PollService;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class PollEdit extends Component
{
    public string $pollId;
    public string $question = '';
    public array $options = [];

    public function mount(string $id, PollRepositoryInterface $pollRepository)
    {
        $poll = $pollRepository->findById($id);
        if (!$poll) return redirect()->route('admin.dashboard');

        $this->pollId = $poll->id;
        $this->question = $poll->question;
        $this->options = $poll->options->pluck('option_text')->toArray();
    }

    public function save(PollService $pollService)
    {
        $this->validate([
            'question' => 'required|min:5',
        ]);

        $pollService->updatePoll($this->pollId, [
            'question' => $this->question,
        ]);

        session()->flash('status', 'Poll updated successfully.');
        return redirect()->route('admin.dashboard');
    }

    public function render()
    {
        return view('livewire.admin.poll-edit');
    }
}
