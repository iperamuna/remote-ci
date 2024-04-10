<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('adduser', function () {

    $user = \App\Models\User::create([
        'name' => 'Admin',
        'email' => 'iperamuna@gmail.com',
        'password' => bcrypt('password'),
        'email_verified_at' => now(),
    ]);

    echo 'User Created';

    print_r($user);

})->purpose('Display an inspiring quote')->hourly();
