<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class pageManeger extends AbstractController
{

    #[Route("/", name: "app_home")]
    public function appHome()
    {
        return $this->render("mainManu/home.html.twig");
    }

    #[Route("/", name: "app_insert")]
    public function appInsert()
    {
        return $this->render("mainManu/home.html.twig");
    }

    #[Route("/", name: "app_show")]
    public function appShow()
    {
        return $this->render("mainManu/home.html.twig");
    }
}
