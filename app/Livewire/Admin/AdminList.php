<?php

namespace App\Livewire\Admin;

use App\Models\Admin;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class AdminList extends Component
{
    public function deleteAdmin(string $id)
    {
        // Don't allow self-deletion for safety in this demo
        if ($id === auth('admin')->id()) {
            session()->flash('error', 'You cannot delete yourself.');
            return;
        }

        Admin::destroy($id);
        session()->flash('status', 'Admin deleted successfully.');
    }

    public function render()
    {
        $admins = Admin::all();
        return view('livewire.admin.admin-list', compact('admins'));
    }
}
