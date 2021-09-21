<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class HealthCheckController extends AbstractController
{
    public function __invoke(): object
    {
        $em = $this->getDoctrine()->getManager();
        $em->getConnection()->connect();

        if ($em->getConnection()->isConnected()) {
            return new JsonResponse('alive');
        }

        throw new ServiceUnavailableHttpException();
    }
}