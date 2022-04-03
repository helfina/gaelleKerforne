# Ma Web App perso - Portfolio

###SOMMAIRE
[Création d'une entité](#Création d'une entité)

  ## Etape du projet

Creation du dossier : 

>`symfony new --webapp gaelleKerforne`

J'ai oublié le --full du coup il ne m'a pas installer le webpack(pour le front)

J'ai du les installer comme ce qui suit : 

>`composer require symfony/webpack-encore-bundle `

 puis : 

>```txt
>    yarn install
>    yarn add node-sass
>    yarn add sass-loader
>    yarn add @fortawesome/fontawesome-free
>    yarn add bootstrap@4.6
>    yarn add jquery
>    yarn add popper.js
>    yarn add file-loader
>```
>
et je compile avec 

>`yarn encore dev`

***************************************************************

###Création de la premiere page HOME :

> `symfony console make:controller`

- Le terminal demande:

>` Choose a name for your controller class (e.g. VictoriousPizzaController): `

>`HomeController`

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

>https://symfony.com/doc/current/security.html

####Phase 1 : création de l'entité User()
>``symfony console make:user``

```txt

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
##Création d'une entité
Ajout de champs dans la table user (entity)

>`symfony console make:entity`

il demande si vous souhaiter mettre a jour ou creer une nouvelle entity :

> `Class name of the entity to create or update (e.g. DeliciousElephant):`
> `User`

il demande le nom ~~du nouveau champs a ajouter~~ (la nouvelle proprieter) : 

> ```text
> New property name (press <return> to stop adding fields):
> > firstname
>  Field type (enter ? to see all types) [string]:
> > Field length [255]: 
> ```

il demande si le champ peut etre null : 

```txt
  Can this field be null in the database (nullable) (yes/no) [no]:
 > no 
```

il demande si l'on veut en ajouter d'autre ou ou pas 

`Add another property? Enter the property name (or press <return> to stop adding fields):
`

Ensuite faire la migration : 

> `symfony console make:migration` 
>
> `symfony console doctrine:migrations:migrate`

>###Docs: 
> 
>Contrainte de validation du formulaire
> https://symfony.com/doc/current/reference/forms/types/form.html#constraints

####Phase 3 : création du formulaire de connexion

on cree un guard authentification
> `symfony console make:auth`

quel style d'authetification vous vouler :
0 un authenticator vide
1 un formulaire de connexion
```console 
What style of authentication do you want? [Empty authenticator]:
[0] Empty authenticator
[1] Login form authenticator`
>1
```

il va cree une class qui permettra de verifier toute les correspondance pour ce connecter

```
The class name of the authenticator to create (e.g. AppCustomAuthenticator):
>LoginFormAuthenticator
Choose a name for the controller class (e.g. SecurityController) [SecurityController]:
 >

```
est-ce-qu'on veut une route de déconnexion

```
Do you want to generate a '/logout' URL? (yes/no) [yes]:
>yes
```

Création de l'espace membre :
> `symfony console make:controller`

>`` Choose a name for your controller class (e.g. FierceGnomeController):
  > AccountController``

gestions de l'espace membre : 

decommenter la ligne  dans le fichier config/packages/security.yaml:

``  # - { path: ^/compte, roles: ROLE_USER }``
on lui dit que toutes les route qui contienne le /compte doit etre connecter avec le role User
```yaml
access_control:
        # - { path: ^/admin, roles: ROLE_ADMIN }
         - { path: ^/compte, roles: ROLE_USER }
```

et créér la redirection a l'espace membre  dans security/LoginFormAuthenticator: 

```php
 public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }

        // For example:
        //return new RedirectResponse($this->urlGenerator->generate('some_route'));
        throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }
```
decommenter la ligne returne et metter la route de votre page:

```php
 public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }
        return new RedirectResponse($this->urlGenerator->generate('app_account'));
        //throw new \Exception('TODO: provide a valid redirect inside '.__FILE__);
    }
```

pour obtenir la liste des route  faite : 

>``symfony console debug:router ``

```txt 
 -------------------------- -------- -------- ------ ----------------------------------- 
  Name                       Method   Scheme   Host   Path                               
 -------------------------- -------- -------- ------ ----------------------------------- 
  _preview_error             ANY      ANY      ANY    /_error/{code}.{_format}           
  _wdt                       ANY      ANY      ANY    /_wdt/{token}                      
  _profiler_home             ANY      ANY      ANY    /_profiler/                        
  _profiler_search           ANY      ANY      ANY    /_profiler/search                  
  _profiler_search_bar       ANY      ANY      ANY    /_profiler/search_bar              
  _profiler_phpinfo          ANY      ANY      ANY    /_profiler/phpinfo                 
  _profiler_search_results   ANY      ANY      ANY    /_profiler/{token}/search/results  
  _profiler_open_file        ANY      ANY      ANY    /_profiler/open                    
  _profiler                  ANY      ANY      ANY    /_profiler/{token}
  _profiler_router           ANY      ANY      ANY    /_profiler/{token}/router
  _profiler_exception        ANY      ANY      ANY    /_profiler/{token}/exception
  _profiler_exception_css    ANY      ANY      ANY    /_profiler/{token}/exception.css
  app_account                ANY      ANY      ANY    /compte
  app_home                   ANY      ANY      ANY    /
  app_register               ANY      ANY      ANY    /inscription
  app_login                  ANY      ANY      ANY    /login
  app_logout                 ANY      ANY      ANY    /logout
 -------------------------- -------- -------- ------ -----------------------------------
```

ajout d'une redirection a son compte si l'utilisateur est connecter :

```php 
class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
    //     if ($this->getUser()) {
    //         return $this->redirectToRoute('target_path');
    //     }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

```

decommenter le if :

```php 
class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
             return $this->redirectToRoute('target_path');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

```

nous allons compartimenter l'espace membres au reste du site

symfony console make:controller
AccountPasswordController

on supprime le template account_password
dans template/account on crre un fichier :  password.html.twig

dans AccountPasswordController on modifie le chemin :
```php 
class AccountPasswordController extends AbstractController
{
    #[Route('/account/password', name: 'app_account_password')]
    public function index(): Response
    {
        return $this->render('account_password/index.html.twig', [
            'controller_name' => 'AccountPasswordController',
        ]);
    }
}
```

```php 
class AccountPasswordController extends AbstractController
{
    #[Route('/compte/password', name: 'app_account_password')]
    public function index(): Response
    {
        return $this->render('account/password.html.twig');
    }
}
```
creation du formulaire pour le changement du mot de pass:

`symfony console make:form`

```txt

>The name of the form class (e.g. TinyChefType):
> ChangePassword

>The name of Entity or fully qualified model class name that the new form will be bound to (empty for none):
> User
```

Creation de l'espace Admin avec easyAdmin

installation :

>https://symfony.com/bundles/EasyAdminBundle/current/index.html

``composer require easycorp/easyadmin-bundle``
`symfony console make:admin:dashboard`

```text
Which class name do you prefer for your Dashboard controller? [DashboardController]:
 >

```
il demande a quelle endroit je souhaite generer ce controller :

```text
In which directory of your project do you want to generate "DashboardController"? [src/Controller/Admin/]:
>
```
dans dashboardController decommenter pour creer le menu
```php
public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
```

```php
public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
         yield MenuItem::linkToCrud('Utilisateur', 'fas fa-list', UserClass::class);
    }
```
le ligne : ``yield MenuItem::linkToCrud('Utilisateur', 'fas fa-list', UserClass::class);``
sert a ajout un lien dans le menu

ensuite faire `symfony console make:admin:crud` 
pour creer les entiter a manager(des controller pour une entite a manager)

```txt
Which Doctrine entity are you going to manage with this CRUD controller?:
  [0] App\Entity\User                                                     
 >    0
  Which directory do you want to generate the CRUD controller in? [src/Controller/Admin/]:
 >  
 Namespace of the generated CRUD controller [App\Controller\Admin]:
 >

```
> [Doc de symfony pour EasyAdmin](https://symfony.com/bundles/EasyAdminBundle/current/crud.html)

> [modification du Dashboard EasyAdmin 4](https://www.youtube.com/watch?v=ze6XJTACo1s) 









































Pour pouvoir recuperate le dossier en local 
- dans la console tape :
>`` git clone <lien du repository>``
>``composer install``



###RESSOURCES DES MODULE A IMPLEMENTER
> [Full Calendar](https://nouvelle-techno.fr/articles/live-coding-utilisation-de-fullcalendar)