<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {
    /**
     * @Route("/", name="home_page")
     */
    public function indexAction() {
        return $this->render('default/home.html.twig');
    }
}