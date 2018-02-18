## Projet DevWeb - Site d'enchères ##

**Site d'enchères** est un projet développé dans le cadre du module
 Développement web : sites dynamiques et développement côté serveur de la
 formation Programmation de sites web du CNAM ([lecnam.net](http://lecnam.net/)).

### Installation ###

Dans un terminal, exécuter les commandes suivantes :
* taper `git clone https://github.com/MaeBzh/enchere.git enchere` pour cloner le dépôt
* alternative : télécharger le projet sous format .zip, et décompressez-le.
* taper `cd enchere` // dossier root du projet
* taper `composer install`
* taper `composer update`
* copier *.env.example* to *.env*
* taper `php artisan storage:link` pour pouvoir accéder aux photos enregistrées dans le dossier storage
* taper `php artisan key:generate` pour générer une clé (`APP_KEY`) dans le fichier *.env*
* configurer les options de connexion à la base de données dans le fichier *.env* :
   * renseigner `DB_HOST`
   * renseigner `DB_DATABASE` 
   * renseigner `DB_USERNAME`
   * renseigner `DB_PASSWORD`
* taper `php artisan migrate` pour créer les tables
* taper `php artisan db:seed` pour générer des jeux de données de démo

### Librairies inclues ###

* [Bootstrap](https://getbootstrap.com/docs/3.3/) en framework CSS (via composer)
* [JQuery](https://api.jquery.com/) en librairie javascript (via CDN)


### Configuration optionnelle ###

Les modification suivantes sont à effectuer dans le fichier *.env* :

* renseigner `DUREE_ENCHERE_JOURS` pour modifier la durée de vente des objets (par défaut 7 jours) 
* renseigner `NB_CREDITS_INSCRIPTION` pour modifier le nombre de crédits reçus lors de l'inscription (par défaut 5 crédits)
* renseigner `NB_CREDITS_MISE_EN_VENTE` pour modifier le coût en crédits d'une mise en vente d'un objet (par défaut 1 crédit)

### Lancer le serveur ### 

Dans un terminal, exécuter la commande suivante :
* taper `php artisan serve`, le service web sera accessible depuis l'adresse http://localhost:8000/

### Traitement des enchères terminées ### 

Dans un terminal, exécuter la commande suivante :
* taper `* * * * * php artisan schedule:run >> /dev/null 2>&1` pour lancer les tâches de fond Laravel de manière continue (via Crontab)
* alternative : taper `php artisan traitement:ventesterminees` pour lancer la tâche de fond sur le traitement des ventes terminées en manuel.
