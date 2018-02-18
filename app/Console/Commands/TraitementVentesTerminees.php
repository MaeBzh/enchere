<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Good;
use App\Mail\EmailInfoVenteTermineeAcheteur;
use App\Mail\EmailInfoVenteTermineeVendeur;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class TraitementVentesTerminees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'traitement:ventesterminees';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Associe l'id du meilleur encherisseur sur les ventes terminées sans acheteur associé.";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
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
                    Mail::to($good->vendeur->email)->send(new EmailInfoVenteTermineeVendeur($good));
                    if ($good->acheteur->exists()) {
                        Mail::to($good->acheteur->email)->send(new EmailInfoVenteTermineeAcheteur($good));
                    }
                }
            }
    }
}
