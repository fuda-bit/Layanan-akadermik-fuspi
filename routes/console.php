<?php

use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance.
|
*/

Artisan::command('inspire', function () {
    $this->comment('Keep building great applications!');
})->purpose('Display an inspiring quote');
