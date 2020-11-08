<?php

namespace App\Controller;

use App\Repository\AboutUsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutAdminController extends AbstractController
{
    /**
     * @Route("/admin/about", name="about_admin_index")
     */
    public function index(AboutUsRepository $repo): Response
    {
        $about = $repo->findAll();
        return $this->render('/admin/about_admin/index.html.twig', [
            'about' => $about
        ]);
    }

    public function aboutCreate()
    {

    }
}
