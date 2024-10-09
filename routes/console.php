<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Schedule::command('telescope:prune --hours=48')->daily();
Schedule::command('backup:clean')->daily()->at('02:00');
Schedule::command('backup:run')->daily()->at('02:30');
