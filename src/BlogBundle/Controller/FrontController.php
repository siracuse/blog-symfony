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

        $posts= $this->getDoctrine()->getManager()->getRepository('BlogBundle:Post')->findAll();
        
        return $this->render('front/accueil.html.twig', [
            'posts' => $posts
        ]);
    }

    // /**
    //  * @Route ("/newPost", name="newPost")
    //  */
    // public function newPostAction() {

    // }

}