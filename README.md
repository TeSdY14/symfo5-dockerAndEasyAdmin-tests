# symfo5-dockerAndEasyAdmin-tests

## Projet Symfony 5 
### Utilitaires
* Mon PC :D 
  * PHPSTORM
  * Terminal : Hyper && Phpstorm Terminal
  * Git Bash 
  * Composer
  * Chrome/Firefox 
  * **Docker && Docker-compose** (voir fin du readme pour plus d'infos) 
  * Symfony CLI 
  
* Technos 
  * PHP 7.4 (extenstions => intl, pdo_pgsql, xsl, amqp, gd, openssl, sodium, ...) 
  * Symfony 5 (Moteur de template TWIG)
  * PostgreSQL 
  * RabbitMQ 

* Bundles 
  * EasyAdmin
  
  
## Dépendances supplémentaires 
### Le SYMFONY PROFILER 
> Installé uniquement pour l'environnement de développement
```shell-script
symfony composer req profiler --dev
```
> '**req**' est l'alias pour le paquet : symfony/profiler-pack
> Le **profiler** permet de gagner du temps quand on a besoin de trouver l'origine d'un problème

### Le LOGGER
```
symfony composer req logger
```

### Outil de debogage
> Installé uniquement pour l'environnement de développement
```
symfony composer req debug --dev
```
>  Permet d'ajouter la **barre de debug** en bas de l'écran du navigateur

### Maker Bundle
> Installé uniquement pour l'environnement de développement
```
symfony composer req maker --dev
```
> Le **maker bundle** permet de générer un grand nombre de classes différentes,
> **pour voir la liste des commandes disponibles avec le maker bundle **
```
symfony console list make 
```

### TWIG
```
composer require symfony/twig-bundle
```
#### Complément pour Twig 
```
symfony composer req "twig/intl-extra:^3"
```
> Le package **intl-extra** fournit les filtres _localizeddate_, _localizednumber_ et _localizedcurrency_ 


### EASYADMIN
> [Plus d'info - Symfony.com](https://symfony.com/doc/current/bundles/EasyAdminBundle/index.html)

> [Plus d'info - Github.com](https://github.com/EasyCorp/EasyAdminBundle)
```
symfony composer req "admin:^2"
```
> Une petite configuration pour améliorer le design de l'administration 
_Editer fichier ./config/packages/easy_admin.yaml_
``` yaml
# Config Basic 
easy_admin: 
  entities: 
    - App\Entity\FooBarOne
    - App\Entity\FooBarTwo 
``` 
> Dans le cas de relation entre 2 classes il est utile d'ajouter une fonction __toString() aux entitées liées 
_Exemple_
``` PHP
class FooBarOne { 
  ...
  public function __toString() {
    return (string) $this->getLeChampARecuperer();
  }
}
``` 
``` yaml 
# Config Avancée
easy_admin: 
  site_name: Mon Beau Site en Symfony 5
  
  design: 
    menu: 
      - { route: 'homepage', label: 'page d''acceuil', icon: 'home' }
      - { entity: 'FooBarOne', label: 'Aller à FooBarOne', icon: 'map-marker' }
      - { entity: 'FooBarTwo', label: 'Aller à FooBarTwo', icon: 'comments' }
      
  entities: 
    FooBarOne
      class: App\Entity\FooBarOne

    FooBarTwo
      class: App\Entity\FooBarTwo
      list: 
        fields:
          - author
          - { property: 'email', type: 'email' }
          - { property: 'createdAt', type: 'datetime' }
        sort: ['createdAt', 'ASC']
        filters: ['conference']
      edit:
        fields: 
          - { property: 'conference' }
          - { property: 'createdAt', type: 'datetime', type_options: { attr: { readonly: true } } }
          - 'author'
          - { property: 'email', type: 'email' }
          - text
``` 
> [Plus d'infos sur la customization d'EasyAdmin](https://symfony.com/doc/2.x/bundles/EasyAdminBundle/book/edit-new-configuration.html) 

> [Plus d'infos sur la customization d'EasyAdmin](https://symfony.com/doc/current/bundles/EasyAdminBundle/index.html)


### PHP Coding Standards Fixer
[Plus d'informations](https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.16/doc/installation.rst)
> Installé uniquement pour l'environnement de développement
```
symfony composer req friendsofphp/php-cs-fixer --dev 
```

### ORM Doctrine
```
symfony composer req "orm:^2"
```
> Commande qui installe un ensemble de bibliothèque afin de gérer la base de données 
_Installation de quelques dépendances_
- Doctrine DBAL (Couche d'abstraction de BDD) 
- Doctrine ORM (Bibliothèque afin de manipuler le contenu de la base de données)
- Doctrine migrations (assistant pour construire la BDD)
#### UNE FOIS INSTALLE 
_Compléter le fichier .env avec les informations d'accès à la base de données_
```# DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7" <<< Ligne commentée```
```DATABASE_URL="postgresql://127.0.0.1:5432/db?serverVersion=13&charset=utf8" # <<< Ligne ajoutée ```

_SYMFONY supporte le **YAML**, **XML**, **PHP** et les **annotations** comme format de configuration_ 
=> [Plus d'informations](https://symfony.com/doc/current/configuration.html#configuration-formats)
- Pour la configuration des paquets, **YAML** est préférable 
- Pour la configuration liées au code PHP, les **annotations** sont plus appropriées, _les informations de configuration sont directement accessibles dans la classe utilisée_. 
### ANNOTATIONS
```
symfony composer req annotations
```

## Commandes du MAKER BUNDLE courantes
> Générer un controller 
```
symfony console make:controller FooBarController
```
> Générer une entité 
```
symfony console make:entity NomEntity
```
> Commande interactive, elle guide durant le processus d'ajout de champs dont l'entité a besoin 
- Nom de la propriété 
- Type de la propriété (taper '?' pour connaitre la liste des possibilités) 
- Longueur (optionnel)
- Nullable Yes-No ? 
Une fois la commande exécutée, deux fichiers sont générés : 
- Classe de l'entité (namespace App\Entity) 
- Repository de l'entité (namespace App\Repository) 
_Retaper la commande make:entity sur une entité déjà existante permettra d'ajouter de nouveaux champs)_

> Générer un formulaire
```
symfony console make:form NomDuForm
```
> Générer un CRUD complet 
```
symfony console make:crud NomDuneEntiteDejaCreee
```
> Cette commande generera plusieurs fichiers
```yaml
-  created: src/Controller/NomDuneEntiteDejaCreeeController.php
-  created: src/Form/NomDuneEntiteDejaCreeeType.php
-  created: templates/nomduneentitedejacreee/_delete_form.html.twig
-  created: templates/nomduneentitedejacreee/_form.html.twig
-  created: templates/nomduneentitedejacreee/edit.html.twig
-  created: templates/nomduneentitedejacreee/index.html.twig
-  created: templates/nomduneentitedejacreee/new.html.twig
-  created: templates/nomduneentitedejacreee/show.html.twig
``` 

## Une fois toutes les entités nécessaires générées 
### Générer le fichier de migration
```
symfony console make:migration
```
### Vérifier les requêtes qui seront exécutées avant de faire la migrations 
> vérifier le contenu du fichier _"./migrations/VersionAnneeMoisJourHeureMinutesSecondes.php"_
### SI OK 
```
symfony console doctrine:migrations:migrate
```
> A la suite de cette commande, la base de données locale sera à jour et prète à stoker des données.


## Ce projet utilise HTTPS
### Installation avec la commande
``` 
symfony server:ca:install 
``` 

## Lancer le serveur symfony
### Lancer le server en arrière plan : 
``` 
symfony server:start -d 
``` 
### Ouvrir dans un navigateur 
``` 
symfony open:local
``` 

## Autres commandes utiles
### Consulter les logs 
``` 
symfony server:log
``` 
### Débogage en production (consulter les logs quand le profiler n'est pas disponible)
``` 
symfony logs
``` 
### Connexion en SSH au conteneur web
``` 
symfony ssh
``` 
### Exposer les variables d'environnements
``` 
symfony var:export
``` 

## DOCKER 
### Démarrer docker compose en arrière plan 
```
docker-compose up -d 
```
### Vérifier que tout fonctionne 
```
docker-composer ps 
```
_Cette commande doit afficher les conteneurs en cours d'exécution_
### Vérifier les logs
``` 
docker-composer logs
``` 

## Accéder à la base de données
Merci à la commande "**symfony**" qui permet de `détecter automatiquement les services Docker en cours d'utilisation`. 

Les variables d'environnement étant exposées, on peut donc utiliser **psql** pour se connecter à la BDD
```
symfony run psql
```

> (si psql n'eest pas disponible en local, Docker permet aussi de l'exécuter : 
```
docker exec -it database_name_1 psql -U username -W password 
```
> Ici dans notre cas cela donne  
```
docker exec -it database_name_1 psql -U main -W main 
```
