<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('page/index.html.twig');
    }

    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('page/home.html.twig');
    }
}
