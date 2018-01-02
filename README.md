## Administration
* Création d'une actualité
* Gestion d'une actualité
* Modifier une actualité
* Poid d'une actualité
* Publication d'une actualié
* Ajouter une catégorie
* Gestion des catégories
* Modifier une catégorie
* Supprimer une catégorie

## Client
* Liste des actualités
* Trier par catégorie
* Page d'une actualité
* Template mise en avant des actualités

## Dépendances
* RefrencementBundle
* GlobalBundle
* Tinymce
* Filemanager
* SweetAlert

## Installation
### Menu
```twig
{% set menuActualite = ['admin_actualite_manager', 'admin_actualite_ajouter', 'admin_actualite_modifier','admin_actualitecategorie_manager', 'admin_actualitecategorie_ajouter', 'admin_actualitecategorie_modifier'] %}

<a href="#" data-nav="actualite-menu" class="menuNav {{ getCurrentMenu(menuActualite) }}"> <i class="fa fa-newspaper-o"></i> Actualités <i class="fa fa-angle-right"></i></a>
<ul class="actualite-menu {{ getCurrentMenu(menuActualite) }}">
    <li class="{{ getCurrentMenu(['admin_actualite_ajouter']) }}"><a href="{{ path('admin_actualite_ajouter')}}">Ajouter une actualité</a></li>
    <li class="{{ getCurrentMenu(['admin_actualite_manager']) }}"><a href="{{ path('admin_actualite_manager')}}">Gestion des actualités</a></li>
    <li class="{{ getCurrentMenu(['admin_actualitecategorie_ajouter']) }}"><a href="{{ path('admin_actualitecategorie_ajouter')}}">Ajouter une catégorie</a></li>
    <li class="{{ getCurrentMenu(['admin_actualitecategorie_manager']) }}"><a href="{{ path('admin_actualitecategorie_manager')}}">Gestion des catégories</a></li>
</ul>
```

### Fichier
* app/AppKernel.php
```php
new ActualiteBundle\ActualiteBundle(),
```
* app/config.yml
```yml
- { resource: "@ActualiteBundle/Resources/config/services.yml" }
```
* app/routing.yml
```yml
actualite:
    resource: "@ActualiteBundle/Resources/config/routing.yml"
    prefix:   /
```
## Client
* Ajouter le dossier web/img/actualite/tmp
* Ajouter le dossier web/img/actualite/minitaure
* Design disponible dans le dossier Install
