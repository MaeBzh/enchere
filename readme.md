## Projet DevWeb - Site d'enchères ##

**Site d'enchères** est un projet développé dans le cadre du module x de la formation y du CNAM ([lecnam.net](http://lecnam.net/)).

### Installation ###

Dans un terminal, executer les commandes suivantes
* type `git clone https://github.com/MaeBzh/enchere.git site_encheres` pour cloner le dépôt 
* type `cd site_encheres`
* type `composer install`
* type `composer update`
* copy *.env.example* to *.env*
* type `php artisan key:generate` pour generer une clé sécurisée dans le fichier *.env*
* Configurer les options de connexion à la base de données dans le fichier *.env* :
   * set DB_CONNECTION
   * set DB_DATABASE
   * set DB_USERNAME
   * set DB_PASSWORD
* type `php artisan migrate` pour créer les tables
* type `php artisan db:seed` pour générer des jeux de données de démo 
* edit *.env* pour utiliser une autre configuration email

### Librairies inclues ###

* [Bootstrap](https://getbootstrap.com/docs/3.3/) en framework CSS (via composer)
* [JQuery](https://api.jquery.com/) en librairie javascript (via CDN)
