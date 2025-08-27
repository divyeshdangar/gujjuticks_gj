<?php

use Illuminate\Support\Facades\Schedule;
 
Schedule::command('app:import-google-alert-news')->everyFiveMinutes();
Schedule::command('app:generate-posts-command')->everyFourMinutes();