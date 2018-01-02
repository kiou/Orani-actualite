## Administration
* Cr�ation d'une actualit�
* Gestion d'une actualit�
* Modifier une actualit�
* Poid d'une actualit�
* Publication d'une actuali�
* Ajouter une cat�gorie
* Gestion des cat�gories
* Modifier une cat�gorie
* Supprimer une cat�gorie

## Client
* Liste des actualit�s
* Trier par cat�gorie
* Page d'une actualit�
* Template mise en avant des actualit�s

## D�pendances
* RefrencementBundle
* GlobalBundle
* Tinymce
* Filemanager
* SweetAlert

## Installation
### Menu
```twig
{% set menuActualite = ['admin_actualite_manager', 'admin_actualite_ajouter', 'admin_actualite_modifier','admin_actualitecategorie_manager', 'admin_actualitecategorie_ajouter', 'admin_actualitecategorie_modifier'] %}

<a href="#" data-nav="actualite-menu" class="menuNav {{ getCurrentMenu(menuActualite) }}"> <i class="fa fa-newspaper-o"></i> Actualit�s <i class="fa fa-angle-right"></i></a>
<ul class="actualite-menu {{ getCurrentMenu(menuActualite) }}">
    <li class="{{ getCurrentMenu(['admin_actualite_ajouter']) }}"><a href="{{ path('admin_actualite_ajouter')}}">Ajouter une actualit�</a></li>
    <li class="{{ getCurrentMenu(['admin_actualite_manager']) }}"><a href="{{ path('admin_actualite_manager')}}">Gestion des actualit�s</a></li>
    <li class="{{ getCurrentMenu(['admin_actualitecategorie_ajouter']) }}"><a href="{{ path('admin_actualitecategorie_ajouter')}}">Ajouter une cat�gorie</a></li>
    <li class="{{ getCurrentMenu(['admin_actualitecategorie_manager']) }}"><a href="{{ path('admin_actualitecategorie_manager')}}">Gestion des cat�gories</a></li>
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
