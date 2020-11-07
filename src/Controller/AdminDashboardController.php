<?php

namespace App\Controller;


use App\Entity\Ad;
use App\Repository\AdRepository;
use App\Services\StatService;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Services\PaginationService;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/admin/{page<\d+>?1}", name="admin_dashboard")
     */
    public function index(ObjectManager $manager,StatService $statsService, $page, PaginationService $pagination, AdRepository $repo)
    {
        //$users = $statsService->getUsersCount();
        //$ads = $statsService->getAdsCount();
       // $comments = $statsService->getCommentsCount();

        $pagination->setEntityClass(Ad::class)
            ->setPage($page);
       $stats = $statsService->getStats();
        
        $bestAds = $statsService->getAdsStats('DESC');
        
        $worstAds = $statsService->getAdsStats('ASC');
       
        return $this->render('admin/dashboard/index.html.twig', [
            'stats' => $stats,
            'bestAds' => $bestAds,
            'worstAds' => $worstAds,
            'pagination' => $pagination
        ]);
    }
}
