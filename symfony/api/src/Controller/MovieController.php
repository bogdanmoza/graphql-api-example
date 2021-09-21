<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\PopularStar;
use App\Entity\TvShow;
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
        $data = [];
        $data['movies'] = $em->getRepository(Movie::class)->getMovies();
        $data['tv-show'] = $em->getRepository(TvShow::class)->getTvShows();
        $data['popular-stars'] = $em->getRepository(PopularStar::class)->getPopularStars();

        return new JsonResponse($data);
    }
}
