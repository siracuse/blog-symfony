<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use BlogBundle\Entity\Post;
use BlogBundle\Form\PostType;

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

    /**
     * @Route ("/newPost", name="newPost")
     */
    public function newPostAction(Request $request) {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            $posts= $this->getDoctrine()->getManager()->getRepository('BlogBundle:Post')->findAll();

            return $this->render('front/accueil.html.twig', [
                'posts' => $posts
            ]);
        }

        return $this->render ('front/newPost.html.twig', [
            'form' => $form->createView()
        ]);

    }

}