<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Good;
use App\Enchere;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $factory = Faker\Factory::create('fr_FR');
        $nb_user = 10;
        for($i=0; $i < $nb_user; $i++){
             
            $username = $factory->unique()->userName;
            $email = "$username@yopmail.com";
            
            $user = new User();
            $user->nom = $factory->unique()->lastName;
            $user->prenom = $factory->firstName;
            $user->email = $email;
            $user->username = $username;
            $user->password = bcrypt('password');
            $user->remember_token = null;
            $user->inscription_token = null;
            $user->inscription_confirmee = true;
            $user->credits = $factory->randomDigit;
            $user->saveOrFail();
        }
        
        $nb_objets_en_ventes = 10;
        for($i=0; $i < $nb_objets_en_ventes; $i++){
            
            $vendeur = User::inRandomOrder()->select('id')->firstOrFail();
            
            $date_fin = $factory->dateTimeBetween('now', '+7 days', 'Europe/Paris');
            $clone_date_fin = clone $date_fin;
            $date_debut = $clone_date_fin->modify("-7 days");
            
            $prix_depart = $factory->randomNumber(2);

            $good = new Good();
            $chemin = Storage::disk("public")->put("photos", file_get_contents("http://lorempixel.com/200/200/technics"));
            // On s'assure que le fichier a bien été enregistré dans l'espace de stockage
            if (Storage::disk("public")->exists($chemin)) {
                $good->photo = $chemin;
            } else {
                $good->photo = null;  // null == public/img_empty.png
            }
            $good->titre = ucfirst($factory->word);
            $good->description = $factory->paragraph;
            $good->prix_depart = $prix_depart;
            $good->prix_final = null;
            $good->date_debut = $date_debut;
            $good->date_fin = $date_fin;
            $good->acheteur_id = null;
            $good->vendeur_id = $vendeur->id;
            $good->saveOrFail();
            
            $nb_encheres = $factory->numberBetween(0, 5);
            for($j=0;$j < $nb_encheres; $j++){
                $encherisseur = User::inRandomOrder()
                        ->where('id', '!=', $vendeur->id)
                        ->select('id')->firstOrFail();
                
                $enchere = new Enchere();
                $enchere->acheteur_id = $encherisseur->id;
                $enchere->good_id = $good->id;
                $enchere->montant = $prix_depart + $j;
                $enchere->date_enchere = $date_debut;
                $enchere->saveOrFail();
            }
        }
        
        $nb_objets_vendus = 10;
        for($i=0; $i < $nb_objets_vendus; $i++){
            
            $vendeur = User::inRandomOrder()->select('id')->firstOrFail();
            $acheteur = User::inRandomOrder()->where('id', '!=', $vendeur->id)->select('id')->firstOrFail();
            
            $date_debut = $factory->dateTimeBetween('-8 days', '-1 day', 'Europe/Paris');
            $clone_date_debut = clone $date_debut;
            $date_fin = $clone_date_debut->modify("+7 days");
            
            $prix_depart = $factory->randomNumber(2);
            $prix_final = $prix_depart + 10;
            
            $good = new Good();
            $chemin = Storage::disk("public")->put("photos", file_get_contents("http://lorempixel.com/200/200/technics"));
            // On s'assure que le fichier a bien été enregistré dans l'espace de stockage
            if (Storage::disk("public")->exists($chemin)) {
                $good->photo = $chemin;
            } else {
                $good->photo = null;  // null == public/img_empty.png
            }
            $good->titre = ucfirst($factory->word);
            $good->description = $factory->paragraph;
            $good->prix_depart = $prix_depart;
            $good->prix_final = $prix_final;
            $good->date_debut = $date_debut;
            $good->date_fin = $date_fin;
            $good->acheteur_id = $acheteur->id;
            $good->vendeur_id = $vendeur->id;
            $good->saveOrFail();
            
            $nb_encheres = $factory->numberBetween(0, 5);
            for($j=0;$j < $nb_encheres; $j++){
                $encherisseur = User::inRandomOrder()
                        ->where('id', '!=', $vendeur->id)
                        ->where('id', '!=', $acheteur->id)
                        ->select('id')->firstOrFail();
                
                $enchere = new Enchere();
                $enchere->acheteur_id = $encherisseur->id;
                $enchere->good_id = $good->id;
                $enchere->montant = $prix_depart + $j;
                $enchere->date_enchere = $date_debut;
                $enchere->saveOrFail();
            }
            
            $enchere_gagnante = new Enchere();
            $enchere_gagnante->acheteur_id = $acheteur->id;
            $enchere_gagnante->good_id = $good->id;
            $enchere_gagnante->montant = $prix_final;
            $enchere_gagnante->saveOrFail();
        }
    }
}
