<?php

namespace ActualiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ActualiteBundle\Form\ActualiteType;
use ActualiteBundle\Entity\Actualite;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ActualiteController extends Controller
{
    /**
     * Ajouter
     */
    public function ajouterAdminAction(Request $request)
    {
        $actualite = new Actualite;
        $form = $this->get('form.factory')->create(ActualiteType::class, $actualite);

        /* Récéption du formulaire */
        if ($form->handleRequest($request)->isValid()){
            $actualite->uploadImage();
            $actualite->getReferencement()->uploadOgimage();

            $em = $this->getDoctrine()->getManager();
            $em->persist($actualite);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'Actualité enregistrée avec succès');
            return $this->redirect($this->generateUrl('admin_actualite_manager'));
        }

        return $this->render('ActualiteBundle:Admin:ajouter.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * Gestion
     */
    public function managerAdminAction(Request $request)
    {
        /* Services */
        $rechercheService = $this->get('recherche.service');
        $recherches = $rechercheService->setRecherche('actualite_manager', array(
                'recherche',
            )
        );

        /* La liste des actualités */
        $actualites = $this->getDoctrine()
                           ->getRepository('ActualiteBundle:Actualite')
                           ->getAllActualites($recherches['recherche'], null, true);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $actualites, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            50/*limit per page*/
        );

        return $this->render('ActualiteBundle:Admin:manager.html.twig',array(
                'pagination' => $pagination,
                'recherches' => $recherches
            )
        );
    }

    /**
     * Publication
     */
    public function publierAdminAction(Request $request, Actualite $actualite){

        if($request->isXmlHttpRequest()){
            $state = $actualite->reverseState();
            $actualite->setIsActive($state);

            $em = $this->getDoctrine()->getManager();
            $em->persist($actualite);
            $em->flush();

            return new JsonResponse(array('state' => $state));
        }

    }

    /**
     * Supprimer
     */
    public function supprimerAdminAction(Request $request, Actualite $actualite)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($actualite);
        $em->flush();

        $request->getSession()->getFlashBag()->add('succes', 'Actualité supprimée avec succès');
        return $this->redirect($this->generateUrl('admin_actualite_manager'));
    }

    /**
     * Poid
     */
    public function poidAdminAction(Request $request, Actualite $actualite, $poid){

        if($request->isXmlHttpRequest()){
            $actualite->setPoid($poid);

            $em = $this->getDoctrine()->getManager();
            $em->persist($actualite);
            $em->flush();

            return new JsonResponse(array('status' => 'succes'));
        }

    }

    /**
     * Modifier
     */
    public function modifierAdminAction(Request $request, Actualite $actualite)
    {
        $form = $this->get('form.factory')->create(ActualiteType::class, $actualite);

        /* Récéption du formulaire */
        if ($form->handleRequest($request)->isValid()){
            $actualite->uploadImage();
            $actualite->getReferencement()->uploadOgimage();

            $em = $this->getDoctrine()->getManager();
            $em->persist($actualite);
            $em->flush();

            $request->getSession()->getFlashBag()->add('succes', 'Actualité enregistrée avec succès');
            return $this->redirect($this->generateUrl('admin_actualite_manager'));
        }

        /* BreadCrumb */
        $breadcrumb = array(
            'Accueil' => $this->generateUrl('admin_page_index'),
            'Gestion des actualités' => $this->generateUrl('admin_actualite_manager'),
            'Modifier une actualité' => ''
        );

        return $this->render('ActualiteBundle:Admin:modifier.html.twig',
            array(
                'breadcrumb' => $breadcrumb,
                'actualite' => $actualite,
                'form' => $form->createView()
            )
        );

    }

    /**
     * Supprimer l'image
     */
    public function AdminSupprimerImageAction(Request $request, Actualite $actualite)
    {
        if($request->isXmlHttpRequest()){
            $em = $this->getDoctrine()->getManager();
            $actualite->setImage(null);
            $em->flush();

            return new JsonResponse(array('state' => 'ok'));
        }
    }

    /**
     * Manager client
     */
    public function managerClientAction(Request $request)
    {

        /* Services */
        $rechercheService = $this->get('recherche.service');
        $recherches = $rechercheService->setRecherche('actualites', array(
                'categorie',
            )
        );

        /* La liste des actualités */
        $actualites = $this->getDoctrine()
                           ->getRepository('ActualiteBundle:Actualite')
                           ->getAllActualites(null, $recherches['categorie'], false);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $actualites, /* query NOT result */
            $request->query->getInt('page', 1) /*page number*/,
            16 /*limit per page*/
        );

        return $this->render('ActualiteBundle:Client:manager.html.twig', array(
                'pagination' => $pagination,
                'recherches' => $recherches
            )
        );
    }

}
