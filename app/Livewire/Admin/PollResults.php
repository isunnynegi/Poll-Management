<?php

namespace App\Livewire\Admin;

use App\Repositories\Interfaces\PollRepositoryInterface;
use App\Services\VoteService;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('layouts.admin')]
class PollResults extends Component
{
    public string $pollId;
    public $poll;
    public $results = [];

    public function mount(string $id, PollRepositoryInterface $pollRepository, VoteService $voteService)
    {
        $this->pollId = $id;
        $this->poll = $pollRepository->findById($id);
        
        if (!$this->poll) {
            return redirect()->route('admin.dashboard');
        }

        $this->results = $voteService->getResults($this->pollId);
    }

    public function getListeners()
    {
        return [
            "echo:poll.{$this->pollId},vote.cast" => 'onVoteCast',
        ];
    }

    public function onVoteCast()
    {
        $this->results = app(VoteService::class)->getResults($this->pollId);
    }

    public function render()
    {
        return view('livewire.admin.poll-results');
    }
}
