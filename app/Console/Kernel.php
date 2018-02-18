<?php

namespace App\Console;

use App\Good;
use App\Mail\EmailInfoVenteTermineeAcheteur;
use App\Mail\EmailInfoVenteTermineeVendeur;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\TraitementVentesTerminees::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Tache de fond qui associe l'id du meilleur encherisseur sur les ventes terminées sans acheteur associé
        $schedule->command(Commands\TraitementVentesTerminees::class)->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
