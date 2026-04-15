<?php

namespace App\Livewire\Admin;

use App\Models\Admin;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class AdminForm extends Component
{
    public $adminId;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public bool $isEdit = false;

    public function mount($id = null)
    {
        if ($id) {
            $admin = Admin::findOrFail($id);
            $this->adminId = $admin->id;
            $this->name = $admin->name;
            $this->email = $admin->email;
            $this->isEdit = true;
        }
    }

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . ($this->adminId ?? 'NULL') . ',id',
        ];

        if (!$this->isEdit) {
            $rules['password'] = 'required|min:8';
        }

        $this->validate($rules);

        if ($this->isEdit) {
            $admin = Admin::findOrFail($this->adminId);
            $admin->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
            if ($this->password) {
                $admin->update(['password' => Hash::make($this->password)]);
            }
        } else {
            Admin::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
        }

        session()->flash('status', $this->isEdit ? 'Admin updated.' : 'Admin created.');
        return redirect()->route('admin.manage.list');
    }

    public function render()
    {
        return view('livewire.admin.admin-form');
    }
}
