<?php

namespace App\Console;

use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        $schedule->call(function () {
            $now = Carbon::now(); // recupera l'ora corrente
            $doctors = Doctor::where('is_sponsored', true)->get(); // recupera tutti i medici sponsorizzati

            foreach ($doctors as $doctor) {
                $pivot = $doctor->sponsoreds()->where('doctor_id', $doctor->id)->first()->pivot; // cerca la correlazione della sponsorizzazione scaduta
                $end = Carbon::create($pivot->end_at);
                if ($now->gt($end)) {
                    $doctor->sponsoreds()->detach($doctor->id); // rimuove la correlazione
                    $doctor->is_sponsored = false; // imposta is_sponsored a false
                    $doctor->save();
                }
            }
            // dd($pivot->end_at);

        })->everyMinute();
    }
    // $schedule->command('inspire')->hourly();


    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
