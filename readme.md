## Projet DevWeb - Site d'enchères ##

**Site d'enchères** est un projet développé dans le cadre du module x de la formation y du CNAM ([lecnam.net](http://lecnam.net/)).

### Installation ###

Dans un terminal, executer les commandes suivantes
* taper `git clone https://github.com/MaeBzh/enchere.git site_encheres` pour cloner le dépôt 
* taper `cd site_encheres`
* taper `composer install`
* taper `composer update`
* copier *.env.example* to *.env*
* taper `php artisan key:generate` pour generer une clé sécurisée dans le fichier *.env*
* configurer les options de connexion à la base de données dans le fichier *.env* :
   * renseigner DB_CONNECTION
   * renseigner DB_DATABASE
   * renseigner DB_USERNAME
   * renseigner DB_PASSWORD
* taper `php artisan migrate` pour créer les tables
* taper `php artisan db:seed` pour générer des jeux de données de démo

### Librairies inclues ###

* [Bootstrap](https://getbootstrap.com/docs/3.3/) en framework CSS (via composer)
* [JQuery](https://api.jquery.com/) en librairie javascript (via CDN)


### Configuration optionnelle ###

Les modification suivantes sont à effectuées dans le fichier *.env* :

* Pour modifier la durée de ventes des objets :
** renseigner DUREE_ENCHERE_JOURS (par défaut 7 jours)

* Pour modifier le nombre de crédits donnés lors de l'inscription : 
** renseigner NB_CREDITS_INSCRIPTION (par défaut 5 crédits)

* Pour modifier le coût en crédits d'une mise en vente d'un objet :
** renseigner NB_CREDITS_MISE_EN_VENTE (par défaut 1 crédit)