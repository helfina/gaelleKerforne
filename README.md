# Ma Web App perso - Portfolio

  ## Etape du projet

Creation du dossier : 

>`` symfony new --webapp gaelleKerforne `` 

j'ai oublier le --full du coup il ne ma pas installer le webpack

j'ai du les installer comme ce qui suit : 

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

>``yarn encore dev``


###Création de la premiere page :

>  ``symfony console make:controller``

- Le terminal demande:

>`` Choose a name for your controller class (e.g. VictoriousPizzaController): ``

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



























































Pour pouvoir recuperate le dossier en local 
- dans la console tape :
>`` git clone <lien du repository>``
>``composer install``