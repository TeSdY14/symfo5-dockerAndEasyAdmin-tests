# 👉 Projet Symfony 5 👈

## ENVIRONNEMENT
* Mon PC (Portable Asus ROG Zephyrus GM501GS-EI003T)
  * Windows 10
  * [PHPStorm](https://www.jetbrains.com/fr-fr/phpstorm/)
  * Terminal : [Hyper](https://hyper.is/) && Phpstorm Terminal
  * [Git Bash - for Windows](https://gitforwindows.org/)
  * [Composer](https://getcomposer.org/)
  * [Chrome](https://www.google.com/intl/fr_fr/chrome/)/[Firefox](https://www.mozilla.org/fr/firefox/new/)/[Edge](https://www.microsoft.com/fr-fr/edge)
  * [Docker && Docker-compose](https://www.docker.com/) (voir fin du readme pour plus d'infos) 
  * [Symfony CLI - x64](https://github.com/symfony/cli/releases/download/v4.21.2/symfony_windows_amd64.exe)
  * [PHP Coding Standards Fixer](https://cs.symfony.com/)
  
* Technos 
  * [PHP](https://www.php.net/) 7.4 (extenstions => intl, pdo_pgsql, xsl, amqp, gd, openssl, sodium, ...) 
  * [Symfony](https://symfony.com/) 5 (Moteur de template TWIG)
  * [Doctrine](https://www.doctrine-project.org/projects/orm.html)
  * [PostgreSQL](https://www.postgresql.org/)
  * [RabbitMQ](https://www.rabbitmq.com/) (faire de l'asynchrone)
  * [Redis](https://redis.io/)
  * [Webpack](https://webpack.js.org/) OU [voir sur Symfony](https://symfony.com/doc/current/frontend.html)
  * [SASS](https://sass-lang.com/) Ou [voir avec Symfony 5 Fast-Track](https://symfony.com/doc/current/the-fast-track/fr/22-encore.html)
  
  * [SPA](https://redis.io/) Application en vue Single Page Application - [voir fin du ReadMe](#spa)

* Bundles 
  * [EasyAdmin](https://symfony.com/doc/current/bundles/EasyAdminBundle/index.html)
  * [dama/doctrine-test-bundle](https://github.com/dmaicher/doctrine-test-bundle)
  
* Docker Images 
  * [postgres:11-alpine](https://www.postgresql.org/) (Base de données) 
  * [redis:5-alpine](https://redis.io/) (stockage de données en mémoire [au format Clé => Valeur] plutot qu'à la manière d'une BDD qui stocke sur Disque Dur
  * [rabbitmq:3.8-management](https://www.rabbitmq.com/) (Agent de message AMQP, permet de gérer les files de message "Queue" de manière asynchrone)
  * [schickling/mailcatcher](https://mailcatcher.me/) (MailCatcher exécute un serveur SMTP et permet une visibilité des messages via une interface web)
	
* Dépendances diverses
  * [Profiler](https://symfony.com/doc/current/profiler.html)
  * [Logger](https://symfony.com/doc/current/logging.html)
  * [Debug - WARNING Deprecated depuis 4.4 - voir ErrorHandlerComponent](https://github.com/symfony/debug)
  * [ErrorHandler Component](https://symfony.com/components/ErrorHandler)
  * [Maker](https://symfony.com/doc/current/bundles/SymfonyMakerBundle/index.html)
  * [Twig - official site](https://twig.symfony.com/doc/2.x/filters/index.html), [twig - symfony](https://symfony.com/doc/current/templates.html) 👈:heavy_plus_sign:👉 [Inky](https://get.foundation/emails/docs/inky.html)
  * [Annotations](https://symfony.com/doc/current/routing.html)
  * [Tests PhpUnit](https://symfony.com/doc/current/testing.html)
  * [Fixtures](https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html)
  * [Subscriber - Events and Event Listeners](https://symfony.com/doc/current/event_dispatcher.html)
  * [MakeFile - Developpez.com](https://gl.developpez.com/tutoriel/outil/makefile/)
  * [Messenger - Component](https://symfony.com/doc/current/components/messenger.html) (faire de l'asynchrone)
  * [Workflow - Component](https://symfony.com/doc/current/components/workflow.html)
  * [Process Component](https://symfony.com/doc/current/components/process.html)
  * [Cache](https://symfony.com/doc/current/components/cache.html) Ou [voir avec Symfony 5 Fast-Track](https://symfony.com/doc/current/the-fast-track/fr/21-cache.html)
  * [Imagine](https://imagine.readthedocs.io/en/stable/#) ou [Voir sur packagist.org](https://packagist.org/packages/imagine/imagine)
  * [Notifier Component](https://symfony.com/components/Notifier)
  
## OUTIL DEVELOPPEMENT : [PHP-FIG](https://www.php-fig.org/psr/)
**>>> Recommandations relatives aux normes PHP <<<**
  
  
## [PROFILER](https://symfony.com/doc/current/profiler.html)
❕Installé uniquement pour l'environnement de développement❕
```shell-script
symfony composer req profiler --dev
```
> '**req**' est l'alias pour **require**

Le **[Profiler](https://symfony.com/doc/current/profiler.html)** permet de gagner du temps quand on a besoin de trouver l'origine d'un problème ⌚!


## [LOGGER](https://symfony.com/doc/current/logging.html) 📑
```
symfony composer req logger
```


## [PHP-CSF](https://cs.symfony.com/) - PHP Coding Standards Fixer :blue_heart:
[Plus d'informations sur GitHub](https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/2.16/doc/installation.rst)
_Installé uniquement pour l'environnement de développement_ (ajout du flag `--dev`)
```
symfony composer req friendsofphp/php-cs-fixer --dev 
```


## [DOCTRINE ORM](https://www.doctrine-project.org/projects/orm.html) :open_file_folder:
```
symfony composer req "orm:^2"
```
> Installe un ensemble de bibliothèque afin de gérer la base de données._
- [Doctrine DBAL](https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/index.html) - Couche d'abstraction de BDD 
- [Doctrine ORM](https://www.doctrine-project.org/projects/orm.html) - Bibliothèque afin de manipuler le contenu de la base de données
- [Doctrine migrations](https://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html) - Assistant pour construire la BDD

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


## [ANNOTATIONS](https://symfony.com/doc/current/routing.html) :pencil2:
```
symfony composer req annotations
```
### Connaitre les routes disponibles 
```
symfony console debug:router
```


## [DEBUG](https://github.com/symfony/debug) ⛔:bug:⛔
> :warning: **ATTENTION! Deprecated depuis v4.4 :**

```
CAUTION: this component is deprecated since Symfony 4.4. Instead, use the ErrorHandler component.
```
> Installé uniquement pour l'environnement de développement
```
symfony composer req debug --dev
```
Cela permet d'obtenir la **barre de debug** en bas de l'écran du navigateur


## [MAKER](https://symfony.com/doc/current/bundles/SymfonyMakerBundle/index.html) :factory:
> Installé **uniquement pour l'environnement de développement**
```
symfony composer req maker --dev
```
Le **maker-bundle** permet de générer un grand nombre de classes différentes.
**Pour voir la liste des commandes disponibles avec le maker bundle**
```
symfony console list make 
```
## Commandes courantes du MAKER BUNDLE

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
#### Vérifier les requêtes qui seront exécutées avant de faire la migrations 
> vérifier le contenu du fichier _"./migrations/VersionAnneeMoisJourHeureMinutesSecondes.php"_
#### ☑️ OK ? 🔄 On migre la BDD 👍 !
```
symfony console doctrine:migrations:migrate
```
A la suite de cette commande, la base de données locale sera à jour et prète à stoker des données.

### Générer un formulaire
```
symfony console make:form NomDuForm
```

### Générer un CRUD complet 
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

### Générer un [SUBSCRIBER - Events and Event Listeners](https://symfony.com/doc/current/event_dispatcher.html) :clipboard:

**Rappel :** 

Un [**_subscriber_**](https://symfony.com/doc/current/event_dispatcher.html) est un [**_listener_**](https://symfony.com/doc/current/event_dispatcher.html) qui contient une méthode statique `_getSubscriberEvents()_` qui retourne sa configration, cela permet aux [**_subscriber_**](https://symfony.com/doc/current/event_dispatcher.html) d'être enregistré automatiquement dans le [**_dispatcher_**](https://symfony.com/doc/current/components/event_dispatcher.html) Symfony 

```
symfony console make:subscriber ExempleTwigEventSubscriber
```
> Commande interactive, elle demandera quel événement ecouter [liste des Evenements](https://symfony.com/doc/current/reference/events.html), 

_Cette liste est normalement affichée dans la console au moment du lancement de la commande_

Une fois validée, la commande créera le fichier `./src/EventSubscriber/ExempleTwigEventSubscriber.php`


## [TWIG - official site](https://twig.symfony.com/doc/2.x/filters/index.html) :eyeglasses: :sunglasses: 
```
composer require symfony/twig-bundle
```
Cette commande installe le moteur de templte Twig 
#### Complément pour Twig 
```
symfony composer req "twig/intl-extra:^3"
```
> Le package **intl-extra** fournit les filtres **_localizeddate_**, **_localizednumber_** et **_localizedcurrency_** 

```
symfony composer req "twig/cssinliner-extra:^3" "twig/inky-extra:^3"
``` 
Installe des extensions Twig utiles à la gestion des emails (notifications par exemple) 

[En savoir plus sur Inky](https://get.foundation/emails/docs/inky.html)

### [WEBPACK](https://webpack.js.org/) OU [Voir sur Symfony.com](https://symfony.com/doc/current/frontend.html)
- Installation 
``` 
symfony composer req encore
``` 

### [SASS](https://sass-lang.com/) OU [voir Symfony 5 Fast-Track](https://symfony.com/doc/current/the-fast-track/fr/22-encore.html)
- Utilisation 
```
mv assets/styles/app.css assets/styles/app.scss
```
#### Installer le loader SASS
- [utile : Lien Node](https://nodejs.org/en/)
- [utile : Lien YARN](https://yarnpkg.com/)
- [utile : Lien NPM](https://www.npmjs.com/)
```
yarn add node-sass "sass-loader@^8.0.0" --dev
```

- Activer dans le `webpack.config.js` : 
```js
.enableSassLoader() // décommenté
```

- Installer Bootstrap Jquery Popper.js (environnement de développement) 
```
yarn add bootstrap jquery popper.js bs-custom-file-input --dev
```

- Ajouter Bootstrap à l'application 

Modifier `./assets/styles/app.scss`
```diff
-body {
-	background-color: lightgray;
- }
+ @import '~bootstrap/scss/bootstrap';
```
Modifier `./assets/app.js`
```diff
+ import 'bootstrap';
+ import bsCustomFileInput from 'bs-custom-file-input';
- // Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
- // import $ from 'jquery';
-
- console.log('Hello Webpack Encore! Edit me in assets/app.js');
+ bsCustomFileInput.init();
```

**STYLES & SCRIPT DU 'GUESTBOOK' MIS A DISPOSITION PAR SYMFONY**
```
php -r "copy('https://symfony.com/uploads/assets/guestbook-5.0.zip',
'guestbook-5.0.zip');"
unzip -o guestbook-5.0.zip
rm guestbook-5.0.zip
```

## [EASYADMIN](https://symfony.com/doc/current/bundles/EasyAdminBundle/index.html) :cop:
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


## [REDIS](https://redis.io/) :zap:
**Redis** est _un système de gestion de base de données_ clef-valeur hautes performances qui **stocke les informations en mémoire** (Les données sont stockées dans la mémoire et est donc plus rapide qu'une base de données qui stocke les données sur disque dur).

Installation 
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
- .symfony/services.yaml
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

1. Arreter Docker 🔴
```
docker-compose stop
```
2. Redémarrer Docker avec redis ✅
```
docker-compose up -d 
```

## CHEAT SHEET Commands 🔑 💡
- [The Symfony Framework Best Practices](https://symfony.com/doc/current/best_practices.html)
- [cheat-sheets.org #Symfony](http://www.cheat-sheets.org/#Symfony)
- [Symfony Configuration Cheat Sheet - pdf](https://files.ripstech.com/cheatsheets/w_symfony_cheat_sheet.pdf)
- [Symfony Configuration Cheat Sheet - webpage](https://blog.ripstech.com/2018/symfony-configuration-cheat-sheet/)
- [Symfony 4 Cheat Sheet (DRAFT)](https://cheatography.com/pluk77/cheat-sheets/symfony-4/)
- [Symfony MODEL DATABASE SCHEMA](https://andreiabohner.files.wordpress.com/2007/09/sfmodelsecondpartrefcard.pdf)

### Lancer le serveur symfony en arrière plan 🏃
``` 
symfony server:start -d 
``` 
### Ouvrir l'application dans un navigateur ➿
``` 
symfony open:local
``` 

### Consulter les logs 🔍
``` 
symfony server:log
``` 

### Consulter les workers en arrière-plan 🔍
``` 
symfony server:status
``` 

### Arrêter un worker (pour obtenir **ID_DU_PROCESSUS** : ```server:status```) ✋
``` 
kill ID_DU_PROCESSUS  
``` 

### Débogage en production (consulter les logs quand le profiler n'est pas disponible) 💂‍
``` 
symfony logs
``` 

### Connexion en SSH au conteneur web 📡 
``` 
symfony ssh
``` 

### Exposer les variables d'environnements 🔍
``` 
symfony var:export
``` 

## _**HTTPS**_
### Activer TLS - Installer le certificat avec la commande 👀
``` 
symfony server:ca:install 
``` 

## [DOCKER](https://www.docker.com/) 🐋
### Commandes
#### Démarrer docker-compose en arrière plan 
```
docker-compose up -d 
```
#### Voir la liste des conteneurs (et leur état)
```
docker-compose ps 
```
_Commande qui affiche toutes les instances de docker qui tournent actuellement sur l'environnement. 
Avec l’option `-a` : les containers stoppés seront aussi affichés._
#### Vérifier les logs
``` 
docker-compose logs
``` 

## Accéder à notre base de données
Merci à la commande "**symfony**" qui permet de **`détecter automatiquement les services Docker en cours d'utilisation`**. 

Les **variables d'environnement** étant exposées, on peut donc utiliser **psql** pour se connecter à la **BDD**
```
symfony run psql
```

> Si **psql** n'eest pas disponible en local, **Docker** permet aussi de l'exécuter
```
docker exec -it database_name_1 psql -U username -W password
```

`ATTENTION !!!`
***Ne pas appeller `docker-compose down`*** afin de ne pas perdre les données. Ou faire une sauvegarde au préalable. 

***Utilisez `pg_dump` pour***

- Sauvegarder la base de données :
```symfony run pg_dump --data-only > dump.sql```
- Restaurez les données :
```symfony run psql < dump.sql```


## [SECURITY](https://symfony.com/doc/current/security.html) ⭐⭐
### Le Composant [`Symfony Security`](https://symfony.com/doc/current/security.html) : Permet de protéger l'accès de certaines pages du site aux utilisateurs
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
_Flag "-n" => **--no-interaction** ou **-n** : Do not ask any interactive question._

### Générer un mot de passe encodé : 
``` 
symfony console security:encode-password
``` 
Cette commande exécute l'utilitaire d'encodage de mot de passe 
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

### Insérer un administrateur via une requête SQL 
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

## [TESTS](https://symfony.com/doc/current/testing.html) :arrow_forward:
Symfony utilise [`PHPUnit`](https://symfony.com/doc/current/testing.html)
```
symfony composer req phpunit --dev 
``` 

- Générer un test
```
symfony console make:unit-test ClassATester
```
### Test de Controller 
_Comme les tests des controlleurs doivent être soumis à des requetes HTTP, il nous faut quelques dépendances supplémentaires_
```
symfony composer req browser-kit --dev
```
`On peut aussi générer le test d'un controller avec` 
```
symfony console make:functional-test Controller\\ConferenceController
```
### Pour ne tester qu'une seule classe précise : (exemple)
```symfony php bin/phpunit tests/Controller/ConferenceControllerTest.php``` 

## [FIXTURES](https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html) 
Les **fixtures** permettent de remplir une base de données avec des données "bidons" afin d'avoir un jeu de données 
```
symfony composer req orm-fixtures --dev
```
_Cette commande génère un répertoire "src/DataFixtures/"

Une fois la classe de fixture complétée afin d'ajouter de fausses données
```
symfony console doctrine:fixtures:load
```

## Automatiser le Workflow avec un [Makefile](https://gl.developpez.com/tutoriel/outil/makefile/)
1. Installer [GNUWine 32](http://gnuwin32.sourceforge.net/) [ou directement ici](http://gnuwin32.sourceforge.net/packages/make.htm)

2. Sur Windows, ajouter la variable d'environnement 

3. Relancer PHPStorm pour prendre en compte les nouvelles variables d'environnement

4. Ajouter un script (nom du fichier 'Makefile') à la racine du repertoire du projet 
```yaml
tests:
	symfony console doctrine:fixtures:load -n
	symfony php bin/phpunit
.PHONY: tests
``` 

5. Lancer le terminal PHPstorm et éxecuter la commande 
```
make tests
```

`Les tests devraient s'exécuter !`

Afin de réinitialiser la base de données entre des tests

```
symfony composer req "dama/doctrine-test-bundle:^6" --dev
```
Valider la recette 

Activer le listener de  [PHPUnit](https://phpunit.de/) (fichier 'phpunit.xml.dist')
```yaml
<phpunit>
....
    <extensions> <!-- Ajout -->
        <extension class="DAMA\DoctrineTestBundle\PHPUnit\PHPUnitExtension" /> <!-- Ajout -->
    </extensions> <!-- Ajout -->
    
    <listeners> <!-- Déjà existant -->
        <listener class="Symfony\Bridge\PhpUnit\SymfonyTestsListener" /> <!-- Déjà existant -->
    </listeners> <!-- Déjà existant -->
</phpunit>
....
```

`Grace à cette commande, toute modification apportée pendant les tests est automatiquement annulée à la fin de chaque test.` 

## [MESSENGER](https://symfony.com/doc/current/messenger.html) :incoming_envelope:
(**TUTO** [SymfonyCast Messenger](https://symfonycasts.com/screencast/messenger))
Le composant Messenger aide les applications à envoyer et à recevoir des messages vers/depuis d'autres applications ou via des files d'attente de messages. [Messenger](https://symfony.com/doc/current/messenger.html)
_NB_ : Le composant [Messenger](https://symfony.com/doc/current/messenger.html) aide les applications à envoyer et à recevoir des messages vers / depuis d'autres applications ou via des files d'attente de messages.

- Installation
``` symfony composer req messenger ```

`> Note de Symfony`
Lorsqu’une **action doit être exécutée de manière asynchrone, envoyez un message à un [Messenger](https://symfony.com/doc/current/messenger.html) [bus](https://fr.wikipedia.org/wiki/Enterprise_service_bus)**. Le [bus](https://fr.wikipedia.org/wiki/Enterprise_service_bus) stocke le message dans une file d’attente et rend immédiatement la main pour permettre au flux des opérations de reprendre aussi vite que possible.

Un **consumer s’exécute continuellement en arrière-plan pour lire les nouveaux messages dans la file d’attente** et exécuter la logique associée.

Le consumer peut s’exécuter sur le même serveur que l’application web, ou sur un serveur séparé.
C’est très **similaire** à la façon dont les **requêtes HTTP** sont traitées, *sauf que nous n’avons pas de réponse*.

Pour un usage simple, voir les fichiers de ce projet : 
- `src/Message/CommentMessage.php` - simple classe de données 
- `src/MessageHandler/CommentMessageHandler.php` - à pour rôle de gestionnaire de messages 
- `src/Controller/ConferenceController` - Montre comment envoyer un message dans le [bus](https://fr.wikipedia.org/wiki/Enterprise_service_bus), afin que le gestionnaire puisse décider ce qu'il va en faire (ce code ne dépend plus du SpamChecker) 

## [RabbitMQ](https://www.rabbitmq.com/documentation.html)
Afin de faire vraiment de l'asynchrone
### "Installation d'[amqp](https://pecl.php.net/package/amqp)"
- Télécharger l'extension [php_amqp](https://pecl.php.net/package/amqp)
- Extraire 
	- php_amqp.dll et php_amqp.pdb => dans le reperoire `/ext/` de la version php en cours d'exécution
	- rabbitmq.4.dll et rabbitmq.4.pdb => dans le reperoire `racine` de php en cours d'exécution
- Ajouter au fichier php.ini : `extension=amqp`
- Redémarrer le serveur (apache ou fermer et relancer le shell) pour prendre en compte la nouvelle extension
- Vérifier avec `php -m` que l'extension est chargée et qu'aucune erreur de chargement de module php 

### Installation de [RabbitMQ](https://www.rabbitmq.com/documentation.html) 🐇
#### Version `docker`

Se rendre dans le repertoire du projet, modifier (ajouter dans) le fichier `docker-compose.yaml`
```yaml
...
  redis:
    image: redis:5-alpine
    ports: [6379]

  rabbitmq:
    image: rabbitmq:3.8-management
    hostname: rabbit
    ports: [5672, 15672]
    networks:
      default:
        aliases:
          - service.rabbitmq
    environment:
      - RABBITMQ_DEFAULT_USER=guest
      - RABBITMQ_DEFAULT_PASS=guest
```

modifier le fichier `messenger.yaml`
```yaml
framework:
    messenger:
        # Uncomment this (and the failed transport below) to send failed messages to this transport for later handling.
        # failure_transport: failed

        transports:
            # https://symfony.com/doc/current/messenger.html#transport-configuration
            async: '%env(RABBITMQ_DSN)%'
            # failed: 'doctrine://default?queue_name=failed'
            # sync: 'sync://'

        routing:
            # Route your messages to the transports
            # 'App\Message\YourMessage': async
            App\Message\CommentMessage: async
```

- Eteindre docker si celui ci est en cours d'exécution 
```docker-compose stop```
- Redémarrer docker avec le nouveau service [RabbitMQ](https://www.rabbitmq.com/documentation.html)
```docker-compose up -d```

- Normalement, l'interface [RabbitMQ](https://www.rabbitmq.com/documentation.html) est accessible `http://127.0.0.1:32784/#/` 
- Ou disponible avec la commande 
```
symfony open:local:rabbitmq
```
- **Utilisateur: guest**
- **Pass: guest**

Pour tester,
- se rendre par exemple : `https://127.0.0.1:8000/conference/bruxelles-2021` 
- Compléter le formulaire de commentaire 
- Soumettre
- Normalement, le message n'apparait pas, il est en "queue" dans [RabbitMQ](https://www.rabbitmq.com/documentation.html)
- Se rendre à `http://127.0.0.1:32784/#/queues` et constater dans le tableau Overview 1 ligne **messages** avec **Ready** à 1
- Pour consommer le message, se rendre dans le terminal : 
```
symfony console messenger:consume async -vv
```
Cette commande devrait immédiatement consommer le message soumis en commentaire  (la console affiche le `messenger worker` en cours d'exécution)

Pour lancer les Workers en arrière plan, éviter d'avoir plein de terminaux ouverts : 
```
symfony run -d --watch=config,src,template,vendor symfony console messenger:consume async
```
```yaml
symfony run -d --watch=config,src,template,vendor symfony console messenger:consume async

Stream the logs via symfony.exe server:log
```
_info :_ 
- **l'option --watch dit à Symfony que la commande est à redémarrer à chaque changement dans un des fichiers config/, vendor/, src/ et templates/**
- Ne pas utiliser le flag -vv afin d'éviter des doublons dans server:log

#### Gestion des message echoués
Messenger propose un mecanisme de relance lorsqu'un problème se produit durant le traitement d'un message (_problème connextion API par exemple_) 

- Un peu de config : `config/packages/messenger.yaml`
```yaml
framework:
    messenger:
        # Uncomment this (and the failed transport below) to send failed messages to this transport for later handling.
        # failure_transport: failed

        transports:
            # https://symfony.com/doc/current/messenger.html#transport-configuration
            async:
                dsn: '%env(RABBITMQ_DSN)%'
                retry_strategy:
                    max_retries: 3
                    multiplier: 2
            failed: 'doctrine://default?queue_name=failed'
            # failed: 'doctrine://default?queue_name=failed'
            # sync: 'sync://'
        failure_transport: failed

        routing:
            # Route your messages to the transports
            # 'App\Message\YourMessage': async
            App\Message\CommentMessage: async
```
## [WORKFLOW](https://symfony.com/doc/current/components/workflow.html)
Afin d'avoir une représentation graphique, il faut [Graphviz](https://www.graphviz.org/)
```
choco install graphviz
```
_Avec graphviz on peut desormais utiliser la commande `dot`_

Installer le composant Workflow de Symfony 
```
symfony composer req workflow
```
- Cette commande ajoute le fichier `config/workflow/workflow.yaml` qu'il faut éditer comme suit (pour notre cas ici de gestion de message en queue)
```yaml
framework:
    workflows:
        comment:
            type: state_machine
            audit_trail:
                enabled: "%kernel.debug%"
            marking_store:
                type: 'method'
                property: 'state'
            supports:
                - App\Entity\Comment
            initial_marking: submitted
            places:
                - submitted
                - ham
                - potential_spam
                - spam
                - rejected
                - published
            transitions:
                accept:
                    from: submitted
                    to: ham
                might_be_spam:
                    from: submitted
                    to: potential_spam
                reject_spam:
                    from: submitted
                    to: spam
                publish:
                    from: potential_spam
                    to: published
                reject:
                    from: potential_spam
                    to: rejected
                publish_ham:
                    from: ham
                    to: published
                reject_ham:
                    from: ham
                    to: rejected
```

Valider le workflow avec 
```
symfony console workflow:dump comment | dot -Tpng -o workflow.png
```

_L'image du workflow (ici **workflow.png**) est ajouté dans le repertoire courant_ 

### Utiliser le workflow 
Voir fichier : `src/MessageHandler/CommentMessageHandler.php`

## [PROCESS](https://symfony.com/doc/current/components/process.html)
Afin de mettre en cache les opérations coûteuses en CPU/ mémoire => créer une commande qui affiche l'étape en cours sur laquelle nous travaillons (le nom du tag Git attaché au commit actuel). 

Le composant **Symfony Process** permet d'éxécuter une commande et de récupérer le résultat. 

* Installation
```
symfony console req process
```
_exemple d'utilisation : `src/Command/StepInfoCommand.php`_

-> Création de la classe `StepInfoCommand` avec : `symfony console make:command app:step:info`

### Mettre le résultat en cache
Afin de mettre le résultat en cache, utiliser le cache symfony.
- Installation
```
symfony composer req cache
```

### IMAGINE - Gérer les images 
Afin de gérer le redimensionnement d’image 
- Installation de la bibliothèque `imagine/imagine`
```
symfony composer req "imagine/imagine:^1.2"
```
### <a href='#spa' id='spa' class='anchor' aria-hidden='true'>SPA</a>
Single Page Application disponible dans `./spa/`

