<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Login as AdminLogin;
use App\Livewire\Admin\Register as AdminRegister;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\PollCreate as AdminPollCreate;
use App\Livewire\Admin\PollEdit as AdminPollEdit;
use App\Livewire\Admin\PollResults as AdminPollResults;
use App\Livewire\Admin\AdminList as AdminList;
use App\Livewire\Admin\AdminForm as AdminForm;
use App\Livewire\Public\PollView;
use Illuminate\Support\Facades\Auth;

// Public routes
Route::get('/', function() { return view('welcome'); })->name('home');
Route::get('/poll/{slug}', PollView::class)->name('poll.view');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', AdminLogin::class)->name('login')->middleware('guest:admin');
    Route::get('/register', AdminRegister::class)->name('register')->middleware('guest:admin');
    
    Route::post('/logout', function() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    })->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('/polls/create', AdminPollCreate::class)->name('polls.create');
        Route::get('/polls/{id}/edit', AdminPollEdit::class)->name('polls.edit');
        Route::get('/polls/{id}/results', AdminPollResults::class)->name('polls.results');
        
        Route::get('/manage/admins', AdminList::class)->name('manage.list');
        Route::get('/manage/admins/create', AdminForm::class)->name('manage.create');
        Route::get('/manage/admins/{id}/edit', AdminForm::class)->name('manage.edit');
    });
});
