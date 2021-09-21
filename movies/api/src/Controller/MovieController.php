<?php

namespace App\Controller;

use App\Entity\Movie;
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
        $data['movies'] = $em->getRepository(Movie::class)->getMovies();

        return new JsonResponse($data);
    }
}
