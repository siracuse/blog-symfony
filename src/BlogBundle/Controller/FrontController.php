<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use BlogBundle\Entity\Post;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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

        $form = $this->get('form.factory')->createBuilder(FormType::class, $post)
            ->add('title', TextType::class)
            ->add('date', DateType::class)
            ->add('author', TextType::class)
            ->add('content', TextType::class)
            ->add('save', SubmitType::class)
            ->getForm()
        ;
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($post);
                $em->flush();
            }

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