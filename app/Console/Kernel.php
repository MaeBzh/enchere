<?php

namespace App\Console;

use App\Good;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Tache de fond qui associe l'id du meilleur encherisseur sur les ventes terminées sans acheteur associé.
        $schedule->call(function () {
            $ventes_terminees_sans_acheteur = Good::where("date_fin", "<", Carbon::now())->whereNull("acheteur_id")->get();
            foreach ($ventes_terminees_sans_acheteur as $good){
                if($good->encheres()->exists()){
                    $enchere_gagnante = $good->encheres()->orderBy("id", "desc")->first();
                    $good->acheteur_id = $enchere_gagnante->acheteur_id;
                    $good->save();
                    // todo envoyer une notification a lacheteur et au vendeur
                }
            }
        })->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
