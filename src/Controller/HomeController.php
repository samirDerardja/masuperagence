<?php

namespace App\Controller;


use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Environment;


class HomeController extends AbstractController
{

    /**
     * @Route("/", name="Home")
     * @param PropertyRepository $repository
     * @return Response
     */


    public function index(PropertyRepository $repository): Response
    {
        $properties = $repository->findLatest();
        return  $this->render('pages/home.html.twig' , [
            'properties' => $properties
        ]);
    }


}

