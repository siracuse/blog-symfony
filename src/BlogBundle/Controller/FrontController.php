<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends Controller {

    
    
    /**
     * @Route ("/", name="accueil")
     */
    public function accueilAction() {
        return $this->render('front/accueil.html.twig');
    }

}