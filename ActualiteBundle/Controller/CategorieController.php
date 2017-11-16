<?php

namespace ActualiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ActualiteBundle\Form\CategorieType;
use ActualiteBundle\Entity\Categorie;

class CategorieController extends Controller
{

    /**
     * Gestion
     */
    public function managerAdminAction(Request $request)
    {
        $categorie = new Categorie;
        $form = $this->get('form.factory')->create(CategorieType::class, $categorie);

        /* Récéption du formulaire */
        if ($form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'Catégorie enregistrée avec succès');
            return $this->redirect($this->generateUrl('admin_actualitecategorie_manager'));
        }

        $categories = $this->getDoctrine()
                           ->getRepository('ActualiteBundle:Categorie')
                           ->findBy(array(),array('id' => 'DESC'));

        return $this->render('ActualiteBundle:Admin/Categorie:manager.html.twig',array(
                'form' => $form->createView(),
                'categories' => $categories,
            )
        );
    }

    /**
     * Supprimer
     */
    public function supprimerAdminAction(Request $request, Categorie $categorie)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($categorie);
        $em->flush();

        $request->getSession()->getFlashBag()->add('succes', 'Catégorie supprimée avec succès');
        return $this->redirect($this->generateUrl('admin_actualitecategorie_manager'));
    }

    /**
     * Modifier
     */
    public function modifierAdminAction(Request $request, Categorie $categorie)
    {
        $form = $this->get('form.factory')->create(CategorieType::class, $categorie);

        /* Récéption du formulaire */
        if ($form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'Catégorie enregistrée avec succès');
            return $this->redirect($this->generateUrl('admin_actualitecategorie_manager'));
        }

        /* BreadCrumb */
        $breadcrumb = array(
            'Accueil' => $this->generateUrl('admin_page_index'),
            'Gestion des catégories' => $this->generateUrl('admin_actualitecategorie_manager'),
            'Modifier une catégorie' => ''
        );

        return $this->render('ActualiteBundle:Admin/Categorie:modifier.html.twig',
            array(
                'breadcrumb' => $breadcrumb,
                'categorie' => $categorie,
                'form' => $form->createView()
            )
        );

    }

}
