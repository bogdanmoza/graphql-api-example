<?php

namespace App\Controller;

use App\Entity\PopularStar;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/movie", name="movie")
     */
    public function index()
    {
        $em = $this->get('doctrine')->getManager();
        $data['popular-stars'] = $em->getRepository(PopularStar::class)->getPopularStars();

        return new JsonResponse($data);
    }
}
