## Administration
* Cr�ation d'une actualit�
* Gestion d'une actualit�
* Modifier une actualit�
* Poid d'une actualit�
* Publication d'une actuali�
* Ajouter une cat�gorie
* Gestion des cat�gories
* Modifier une cat�gorie

## Client
* Liste des actualit�s
* Trier par cat�gorie
* Page d'une actualit�
* Template mise en avant des actualit�s

## D�pendances
* RefrencementBundle
* img/actualite/tmp
* img/actualite/miniature
* Ajouter le menu dans le template menu du bundle GlobalBundle

## Menu
```twig
{% set menuActualite = ['admin_actualite_manager', 'admin_actualite_ajouter', 'admin_actualite_modifier'] %}

<a href="#" data-nav="actualite-menu" class="menuNav {{ getCurrentMenu(menuActualite) }}"> <i class="fa fa-newspaper-oxt"></i> Actualit�s <i class="fa fa-angle-right"></i></a>
<ul id="actualite-menu" class="{{ getCurrentMenu(menuActualite) }}">
    <li class="{{ getCurrentMenu(['admin_actualite_ajouter']) }}"><a href="{{ path('admin_actualite_ajouter')}}">Ajouter une actualit�</a></li>
    <li class="{{ getCurrentMenu(['admin_actualite_manager']) }}"><a href="{{ path('admin_actualite_manager')}}">Gestion des actualit�s</a></li>
</ul>
```