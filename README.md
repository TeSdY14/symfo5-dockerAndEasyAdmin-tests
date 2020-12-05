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
> '**req**' est l'alias pour le paquet : **symfony/profiler-pack**

Le **PROFILER** permet de gagner du temps quand on a besoin de trouver l'origine d'un problème!

### Le LOGGER
```
symfony composer req logger
```

### Outil de debogage
> Installé uniquement pour l'environnement de développement
```
symfony composer req debug --dev
```
Cela permet d'obtenir la **barre de debug** en bas de l'écran du navigateur

### Maker Bundle
> Installé uniquement pour l'environnement de développement
```
symfony composer req maker --dev
```
Le **maker-bundle** permet de générer un grand nombre de classes différentes.
**Pour voir la liste des commandes disponibles avec le maker bundle**
```
symfony console list make 
```

### TWIG
```
composer require symfony/twig-bundle
```
Cette commande installe le moteur de templte Twig 
#### Complément pour Twig 
```
symfony composer req "twig/intl-extra:^3"
```
> Le package **intl-extra** fournit les filtres **_localizeddate_**, **_localizednumber_** et **_localizedcurrency_** 


### EASYADMIN
[Plus d'info sur Symfony.com](https://symfony.com/doc/current/bundles/EasyAdminBundle/index.html)

[Plus d'info sur Github.com](https://github.com/EasyCorp/EasyAdminBundle)
```
symfony composer req "admin:^2"
```
> Un exemple de configurations pour améliorer le design de l'administration 
_ Éditer le fichier ./config/packages/easy_admin.yaml_
1. Configuration Basique 
``` yaml
# Config Basic 
easy_admin: 
  entities: 
    - App\Entity\FooBarOne
    - App\Entity\FooBarTwo 
``` 
`Dans le cas de relation entre 2 classes il est utile d'ajouter une fonction "__toString()"" aux entitées liées!` 
``` PHP
class FooBarOne { 
  ...
  public function __toString() {
    return (string) $this->getLeChampARecuperer();
  }
}
``` 
2. Configuration Avancée
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
> [Plus d'infos sur la customization d'EasyAdmin sur symfony.com](https://symfony.com/doc/2.x/bundles/EasyAdminBundle/book/edit-new-configuration.html) 

> [Plus d'infos sur la customization d'EasyAdmin sur symfony.com](https://symfony.com/doc/current/bundles/EasyAdminBundle/index.html)


### PHP Coding Standards Fixer
[Plus d'informations sur GitHub](https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.16/doc/installation.rst)
_Installé uniquement pour l'environnement de développement_ (ajout du flag `--dev`)
```
symfony composer req friendsofphp/php-cs-fixer --dev 
```

### ORM Doctrine
```
symfony composer req "orm:^2"
```
> Installe un ensemble de bibliothèque afin de gérer la base de données.
- Doctrine DBAL (Couche d'abstraction de BDD) 
- Doctrine ORM (Bibliothèque afin de manipuler le contenu de la base de données)
- Doctrine migrations (assistant pour construire la BDD)

UNE FOIS INSTALLE 
_Compléter le fichier `.env` avec les informations d'accès à la base de données_
```yaml 
#DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7" <<< Ligne commentée
```
```yaml 
DATABASE_URL="postgresql://127.0.0.1:5432/db?serverVersion=13&charset=utf8" # <<< Ligne ajoutée
```

_SYMFONY supporte le **YAML**, **XML**, **PHP** et les **annotations** comme format de configuration_ 
=> [Plus d'informations](https://symfony.com/doc/current/configuration.html#configuration-formats)
- Pour la configuration des paquets, **YAML** est préférable 
- Pour la configuration liées au code PHP, les **annotations** sont plus appropriées, _les informations de configuration sont directement accessibles dans la classe utilisée_. 

### ANNOTATIONS
```
symfony composer req annotations
```

### REDIS
```
composer require predis/predis
```
Un peu de configuration 

- symfony.cloud.yaml
```yaml
runtime: 
 extension: 
  - pdo_pgsl
  - apcu
  - redis # LIGNE A AJOUTER !
  ...
  ...
relationships:
 database: "db:postgresql"
 redis: "rediscache:redis" # LIGNE A AJOUTER 
```
- .symfony/serices.yaml
```yaml
...
# ajouter ce qui suit : 
rediscache: 
 type: redis:5.0
```

- config/packages/framework.yaml
```yaml
...
session:
 # REMPLACER 
 # handler_id: null 
 # PAR  
 handler_id: '%env(REDIS_URL)%'
rediscache: 
 type: redis:5.0
```

- docker-compose.yaml
```yaml
...
 redis:
  image: redis:5-alpine
  ports: [6379]
```
Mettre en route Redis avec Docker : 

1. Arreter Docker
```
docker-compose stop
```
2. Redémarrer Docker avec redis 
```
docker-compose up -d 
```

## Commandes du MAKER BUNDLE courantes
### Connaitre les routes disponibles 
```
symfony console debug:router
```
### Générer un controller 
```
symfony console make:controller FooBarController
```

### Générer une entité 
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

#### Une fois toutes les entités nécessaires générées, Générer le fichier de migration
```
symfony console make:migration
```
### Vérifier les requêtes qui seront exécutées avant de faire la migrations 
> vérifier le contenu du fichier _"./migrations/VersionAnneeMoisJourHeureMinutesSecondes.php"_
### OK ? On migre la BDD !
```
symfony console doctrine:migrations:migrate
```
A la suite de cette commande, la base de données locale sera à jour et prète à stoker des données.

#### Générer un formulaire
```
symfony console make:form NomDuForm
```

#### Générer un CRUD complet 
```
symfony console make:crud NomDuneEntiteDejaCreee
```
Cette commande va générer plusieurs fichiers :
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

#### Générer un SUBSCRIBER

**Rappel :** 

Un [**_subscriber_**](https://symfony.com/doc/current/event_dispatcher.html) est un [**_listener_**](https://symfony.com/doc/current/event_dispatcher.html) qui contient une méthode statique `_getSubscriberEvents()_` qui retourne sa configration, cela permet aux [**_subscriber_**](https://symfony.com/doc/current/event_dispatcher.html) d'être enregistré automatiquement dans le [**_dispatcher_**](https://symfony.com/doc/current/components/event_dispatcher.html) Symfony 

```
symfony console make:subscriber ExempleTwigEventSubscriber
```
> Commande interactive, elle demandera quel événement ecouter [liste des Evenements](https://symfony.com/doc/current/reference/events.html), 

_Cette liste est normalement affichée dans la console au moment du lancement de la commande_

Une fois validée, la commande créera le fichier `./src/EventSubscriber/ExempleTwigEventSubscriber.php`

## Autres Commandes Utiles
### Lancer le serveur symfony en arrière plan
``` 
symfony server:start -d 
``` 
### Ouvrir l'application dans un navigateur 
``` 
symfony open:local
``` 

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

## Ce projet utilise _**HTTPS**_
### Installer un certificat  avec la commande
``` 
symfony server:ca:install 
``` 

## Gestion avec DOCKER 
### Démarrer docker-compose en arrière plan 
```
docker-compose up -d 
```
### Voir la liste des conteneurs (et leur état)
```
docker-compose ps 
```
_Commande qui affiche toutes les instances de docker qui tournent actuellement sur l'environnement. 
Avec l’option `-a` : les containers stoppés seront aussi affichés._
### Vérifier les logs
``` 
docker-compose logs
``` 

## Accéder à notre base de données
Merci à la commande "**symfony**" qui permet de `détecter automatiquement les services Docker en cours d'utilisation`. 

Les **variables d'environnement** étant exposées, on peut donc utiliser **psql** pour se connecter à la **BDD**
```
symfony run psql
```

> Si **psql** n'eest pas disponible en local, **Docker** permet aussi de l'exécuter
```
docker exec -it database_name_1 psql -U username -W password
```

## SECURITÉ 
### Le Composant `Symfony Security` : Permet de protéger l'accès de certaines pages du site aux utilisateurs
```
symfony composer req security
```
### Définir une entité User (ici nommé Admin)
``` 
symfony console make:user Admin
``` 
> Commande interactive : 
```
- Do you want to store user data in the database (via Doctrine)? (yes/no) [yes]: 
YES
```
```
- Enter a property name that will be the unique "display" name for the user (e.g. email, username, uuid) [email] : 
username
```
```
Does this app need to hash/check user passwords? (yes/no) [yes]:
YES
```

_**Une fois la commande exécutée, les fichiers suivants seront générés/modifiés.**_ 
```yaml
created: src/Entity/Admin.php
created: src/Repository/AdminRepository.php
updated: src/Entity/Admin.php
updated: config/packages/security.yaml
           
  Success! 
           
```
Attardons nous sur le fichier config/packages/security.yaml. 

Les lignes suivantes ont été automatiquement ajoutées au fichier : 
```yaml
security:
    encoders: # Ajouté
        App\Entity\Admin: # Ajouté
            algorithm: auto # Ajouté

    # https://symfony.com/doc/current/security.html#where-do-users-come-from-user-providers
    # in_memory: { memory: null }  # RETIRÉ
    providers:
        # used to reload user from session & other features (e.g. switch_user)  # Ajouté
        app_user_provider: # Ajouté
            entity: # Ajouté
                class: App\Entity\Admin # Ajouté
                property: username # Ajouté
    firewalls:
    ....
``` 

### Générer la migration et migrer la BDD 
```
symfony console make:migration 
symfony console doctrine:migration:migrate -n
``` 
_Flag -n => **--no-interaction** ou **-n** : Do not ask any interactive question._

### Générer un mot de passe encodé : 
``` 
symfony console security:encode-password
``` 
Cette commande l'utilitaire d'encodage de mot de passe 
```yaml 
Symfony Password Encoder Utility
================================

 Type in your password to be encoded:
> admin
 ------------------ ---------------------------------------------------------------------------------------------------
  Key                Value                                                                                             
 ------------------ ---------------------------------------------------------------------------------------------------
  Encoder used       Symfony\Component\Security\Core\Encoder\MigratingPasswordEncoder
  Encoded password   $argon2id$v=19$m=65536,t=4,p=1$KUtC39eZrJiWmGjxBpyrKA$KN1vUaevtOha+F1+bTdXM2+FgWvJw+p3QBoXM+QpRoA
 ------------------ ---------------------------------------------------------------------------------------------------

 ! [NOTE] Self-salting encoder used: the encoder generated its own built-in salt.                           
 
 [OK] Password encoding succeeded                  
```

### Insérer un administrateur, utilisons une simple requête SQL 
```sh
symfony run psql -c "INSERT INTO admin (id, username, roles, password) VALUES (nextval('admin_id_seq'), 'admin', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$9G08Ahe3JnpX8TI1
R0kolQ$HoQOUUnsabZvE87yWVLPP/pUJ251PyV3p2mK9xHmm1c');"
```

(Si problème avec le mot de passe, essayé avec des `\` devant les `$`)
### Générer un système d'authentification
```yaml
symfony console make:auth
 What style of authentication do you want? [Empty authenticator]:
  [0] Empty authenticator
  [1] Login form authenticator
> 1 
The class name of the authenticator to create (e.g. AppCustomAuthenticator):
 > AppAuthenticator
Choose a name for the controller class (e.g. SecurityController) [SecurityController]: 
Entrée (ou taper 'SecurityController' et Entrée)
 > SeurityController
Do you want to generate a '/logout' URL? (yes/no) [yes]: Entrée (ou taper 'Yes' et Entrée)
 > Yes
created: src/Security/AppAuthenticator.php
updated: config/packages/security.yaml
created: src/Controller/SecurityController.php
created: templates/security/login.html.twig

           
  Success! 
           

 Next:
 - Customize your new authenticator.
 - Finish the redirect "TODO" in the App\Security\AppAuthenticator::onAuthenticationSuccess() method.
 - Review & adapt the login template: templates/security/login.html.twig.

```

De nouvelles lignes sont automatiquement ajoutées au fichier `./config/paclages/security.yaml`
```
main:
            anonymous: lazy
            provider: app_user_provider
            guard: # AJOUTÉ
                authenticators: # AJOUTÉ
                    - App\Security\AppAuthenticator # AJOUTÉ
            logout: # AJOUTÉ
                path: app_logout # AJOUTÉ
                # where to redirect after logout
                # target: app_any_route

            # activate different ways to authenticate
```
[Pour générer un système complet d'authentification par formulaire](https://symfony.com/doc/current/doctrine/registration_form.html)
```
symfony console make:registration-form
```

## TESTS 
Symfony utilise `PHPUnit`
```
symfony composer req phpunit --dev 
``` 

- Générer un test
```
symfony console make:unit-test ClassATester
```
