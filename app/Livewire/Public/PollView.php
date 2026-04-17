<?php

namespace App\Livewire\Public;

use App\Repositories\Interfaces\PollRepositoryInterface;
use App\Services\VoteService;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class PollView extends Component
{
    public string $slug;
    public $poll;
    public $results = [];
    public $hasVoted = false;
    public $selectedOption = null;

    public function mount(string $slug, PollRepositoryInterface $pollRepository, VoteService $voteService)
    {
        $this->slug = $slug;
        $this->loadPoll($pollRepository, $voteService);
    }

    public function loadPoll(PollRepositoryInterface $pollRepository, VoteService $voteService)
    {
        $this->poll = $pollRepository->findBySlug($this->slug);
        
        if (!$this->poll) {
            abort(404);
        }

        $this->hasVoted = $voteService->hasVoted(
            $this->poll->id,
            Auth::id(),
            request()->ip()
        );

        $this->results = $voteService->getResults($this->poll->id);
    }

    public function getListeners()
    {
        return [
            "echo:poll.{$this->poll->id},.vote.cast" => 'onVoteCast',
        ];
    }

    public function onVoteCast()
    {
        $this->results = app(VoteService::class)->getResults($this->poll->id);
    }

    public function vote(VoteService $voteService)
    {
        if (!$this->selectedOption) {
            session()->flash('error', 'Please select an option.');
            return;
        }

        $vote = $voteService->castVote(
            $this->poll->id,
            $this->selectedOption,
            Auth::id(),
            request()->ip()
        );

        if ($vote) {
            $this->hasVoted = true;
            $this->results = $voteService->getResults($this->poll->id);
            session()->flash('status', 'Thank you for voting!');
        } else {
            session()->flash('error', 'You have already voted on this poll.');
        }
    }

    public function render()
    {
        return view('livewire.public.poll-view')->layout('layouts.app');
    }
}
