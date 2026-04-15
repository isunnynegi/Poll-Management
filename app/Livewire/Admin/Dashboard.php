<?php

namespace App\Livewire\Admin;

use App\Repositories\Interfaces\PollRepositoryInterface;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Dashboard extends Component
{
    public function deletePoll(string $id, PollRepositoryInterface $pollRepository)
    {
        $pollRepository->delete($id);
        session()->flash('status', 'Poll deleted successfully.');
    }

    public function render(PollRepositoryInterface $pollRepository)
    {
        $polls = $pollRepository->getAllByAdmin(Auth::guard('admin')->id());
        return view('livewire.admin.dashboard', compact('polls'));
    }
}
