# Ma Web App perso - Portfolio

  ## Etape du projet

Creation du dossier : 

>`` symfony new --webapp gaelleKerforne `` 

J'ai oublié le --full du coup il ne m'a pas installer le webpack(pour le front)

J'ai du les installer comme ce qui suit : 

>`` composer require symfony/webpack-encore-bundle ``

 puis : 

```txt
    yarn install
    yarn add node-sass
    yarn add sass-loader
    yarn add @fortawesome/fontawesome-free
    yarn add bootstrap@4.6
    yarn add jquery
    yarn add popper.js
    yarn add file-loader
```
et je compile avec 

>`yarn encore dev`

***************************************************************

###Création de la premiere page HOME :

>  `symfony console make:controller`

- Le terminal demande:

>` Choose a name for your controller class (e.g. VictoriousPizzaController): `

>``HomeController``

  - Une fois le controller crée pour que cela devienne la page principale dans le HomeController remplacer la
  route 
  
>``#[Route('/home', name: 'app_home')]``

par 

>``#[Route('/', name: 'app_home')]``


Exemple:

```php
  class HomeController extends AbstractController 
  { 
      #[Route('/', name: 'app_home')]
      public function index(): Response 
      { 
            return $this->render('home/index.html.twig'); 
      } 
  }
  ```
***************************************************************

### Création de l'espace Membres

https://symfony.com/doc/current/security.html

####Phase 1 : création de l'entité User()
``symfony console make:user``

```php

The name of the security user class (e.g. User) [User]:
 > User

 Do you want to store user data in the database (via Doctrine)? (yes/no) [yes]:
 > yes

 Enter a property name that will be the unique "display" name for the user (e.g. email, username, uuid) [email]:
 > email

 Will this app need to hash/check user passwords? Choose No if passwords are not needed or will be checked/hashed by some other system (e.g. a single sign-on server).

 Does this app need to hash/check user passwords? (yes/no) [yes]:
 > yes

 created: src/Entity/User.php
 created: src/Repository/UserRepository.php
 updated: src/Entity/User.php
 updated: config/packages/security.yaml
```
  - creer la database avec doctrine : 

modifier ici :

`DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7&charset=utf8mb4"`

puis faire : 

`symfony console  doctrine:database:create`

pour migrer sa table :

>`symfony console make:migration`

>`symfony console doctrine:migrations:migrate`


####Phase 2 : création du formulaire d'inscription
  - creation du controlleur d'inscription :

>  `symfony console make:controller`
> `RegisterController`

  - creation du formulaire 
> docs : 
> https://symfony.com/doc/current/reference/forms/types.html#field-groups


>`symfony console make:form`

 ```php
The name of the form class (e.g. DeliciousGnomeType):
 > Resgiter
``` 
avec quelle entite tu veux faire le liens :

```php 
 The name of Entity or fully qualified model class name that the new form will be bound to (empty for none):
 > User
```
Mise en place du theme pour les formulaires :

https://symfony.com/doc/current/form/bootstrap5.html

> config/packages/twig.yaml

ajouter:

```yaml
twig:
  form_themes: ['bootstrap_5_layout.html.twig']
```

Ajout de champs dans la table user (entity)

`symfony console make:entity`

il demande si vous souhaiter mettre a jour ou creer une nouvelle entity :

> `Class name of the entity to create or update (e.g. DeliciousElephant):`
> `User`

il demande le nom ~~du nouveau champs a ajouter~~ (la nouvelle proprieter) : 

> `New property name (press <return> to stop adding fields):
> firstname
>  Field type (enter ? to see all types) [string]:
> 
> Field length [255]:
>
`
il demande si le champ peut etre null : 

>` Can this field be null in the database (nullable) (yes/no) [no]:
> no
`

il demande si l'on veut en ajouter d'autre ou ou pas 

`Add another property? Enter the property name (or press <return> to stop adding fields):
`

Ensuite faire la migration : 

> `symfony console make:migration` 
> `symfony console doctrine:migrations:migrate`

>###Docs: 
>Contrainte de validation du formulaire
> https://symfony.com/doc/current/reference/forms/types/form.html#constraints

####Phase 3 : création du formulaire de connexion


























































Pour pouvoir recuperate le dossier en local 
- dans la console tape :
>`` git clone <lien du repository>``
>``composer install``