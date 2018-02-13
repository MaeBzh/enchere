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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Tache de fond qui associe l'id du meilleur encherisseur sur les ventes terminées sans acheteur associé.
        $schedule->call(function () {
            $ventes_terminees_non_traitees = Good::where("date_fin", "<", Carbon::now())
                ->whereNull("prix_final")
                ->get();
            foreach ($ventes_terminees_non_traitees as $good) {
                if ($good->encheres()->exists()) {
                    $enchere_gagnante = $good->encheres()->orderBy("id", "desc")->first();
                    $good->acheteur_id = $enchere_gagnante->acheteur_id;
                    $good->prix_final = $enchere_gagnante->montant;
                } else {
                    $good->prix_final = $good->prix_depart;
                }
                if ($good->save()) {
                    if ($good->acheteur->exists()) {
                        Mail::to($good->acheteur->email)->send(new EmailInfoVenteTermineeAcheteur($good));
                    }
                    Mail::to($good->vendeur->email)->send(new EmailInfoVenteTermineeVendeur($good));
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
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
