<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Volt::route('/auth/login', 'auth.login')->name('login');

Route::get('/auth/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
});

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect('/dashboard');
    });

    Volt::route('/dashboard', 'dashboard');

    Volt::route('/projects', 'projects.index');
    Volt::route('/projects/create', 'projects.create');
    Volt::route('/projects/{project}', 'projects.show');
    Volt::route('/projects/{project}/edit', 'projects.edit');

    Volt::route('/projects/{project}/servers/create', 'servers.create');
    Volt::route('/projects/{project}/servers/{server}', 'servers.show');
    Volt::route('/projects/{project}/servers/{server}/edit', 'servers.edit');


});
