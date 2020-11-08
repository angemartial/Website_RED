<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AnnonceType;
use App\Repository\AdRepository;
use App\Services\PaginationService;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AdminAdController extends AbstractController
{
    /**
     * Undocumented function
     * @Route("/admin/ads/{page<\d+>?1}", name="admin_ads_index")
     *
     */
    public function index(AdRepository $repo, $page,PaginationService $pagination)
    {
        $pagination->setEntityClass(Ad::class)
            ->setPage($page);

        return $this->render('admin/ad/index.html.twig', [
            'pagination' => $pagination
        ]);
    }


    /**
     * permet de créer une nouvelle annonce
     *
     * @Route("/admin/ads/new", name ="admin_ads_create")
     *
     *
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $ad = new Ad();

        $form = $this->createForm(AnnonceType::class, $ad);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            //joindre l'utilisateur connecté à son annonce

//            $ad->setAuthor($this-getUser());

            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre annonce' .$ad->getTitle(). 'a bien été envoyé'
            );

            return $this->redirectToRoute('ads_show', [
                'slug' => $ad->getSlug()
            ]);

        }


        return $this->render('admin/ad/new.html.twig',[
            'form' => $form->createView()
        ]);

    }


    /**
     * permet d'éditer une annonce
     *
     *@Route("/admin/ads/{id}/edit", name="admin_ads_edit")
     * @param Ad $ad
     * @return Response
     */
    public function edit(Ad $ad, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(AnnonceType::class, $ad);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre annonce <strong>{$ad->getTitle()}</strong> a bien été modifiée !"
            );
        }


        return $this->render('admin/ad/edit.html.twig', [
            'ad' => $ad,
            'form' => $form->createView()
        ]);

    }


    /**
     * permet de supprimer une annonce
     *
     * @Route("/admin/ads/{id}/delete", name="admin_ads_delete")
     *
     * @param Ad $ad
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Ad $ad,Request $request,ObjectManager $manager)
    {
            $manager->remove($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce {$ad->getTitle()} a bien été supprimée "
            );
        return $this->redirectToRoute('admin_ads_index');

    }
}
