<?php

namespace App\Controller;

use App\Repository\AboutUsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/aboutus", name="about_us_index")
     */
    public function index(AboutUsRepository $repo)
    {
        $abouts = $repo->findAll();
        return $this->render('about/about.html.twig', [
            'abouts' => $abouts
        ]);
    }
}
