<?php

namespace App\Livewire\Admin;

use App\Services\PollService;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class PollCreate extends Component
{
    public string $question = '';
    public array $options = ['', '']; // Start with 2 empty options

    public function addOption()
    {
        $this->options[] = '';
    }

    public function removeOption(int $index)
    {
        if (count($this->options) > 2) {
            unset($this->options[$index]);
            $this->options = array_values($this->options);
        }
    }

    public function save(PollService $pollService)
    {
        $this->validate([
            'question' => 'required|min:5',
            'options.*' => 'required|min:1',
            'options' => 'array|min:2',
        ]);

        $pollService->createPoll([
            'question' => $this->question,
            'options' => $this->options,
        ], Auth::guard('admin')->id());

        session()->flash('status', 'Poll created successfully.');
        return redirect()->route('admin.dashboard');
    }

    public function render()
    {
        return view('livewire.admin.poll-create');
    }
}
