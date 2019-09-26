<?php

namespace BienBundle\Controller;

use BienBundle\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BienController extends Controller {


//    Reponse classique
    /**
     * @Route ("/accueil")
     */
    public function accueilAction() {
        return new Response('Bienvenue sur l\'accueil');
    }



//    TEMPLATE TWIG
    /**
     * @Route ("/twig")
     */
    public function indexAction() {

        $number = 15;

        return $this->render('lucky/number.html.twig', [
            'number' => $number,
        ]);

    }

//    REDIRECTION
    /**
     * @Route ("/hari")
     */
    public function hariAction() {
        return $this->redirect('https://siracuseharichandra.alwaysdata.net/');
    }

    /**
     * @Route ("/age-{nombre}")
     */
    public function ageAction($nombre) {
//        $nombre = 4;
        return $this->render('age/age.html.twig', [
            'age' => $nombre,
        ]);
    }


    /**
     * @Route ("/newpost")
     */
    public function newpostAction(Request $request) {
        $commentaire = new Blog();
        $commentaire->setDate(new \DateTime());
        $commentaire->setTitle('titre');
        $commentaire->setAuthor('auteur');
        $commentaire->setContant('mon très long message');
        $commentaire->setPublished(true);

        $em = $this->getDoctrine()->getManager();

        $em->persist($commentaire);

        $em->flush();

        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée');

            return $this->render('blog/post.html.twig', [
                'id' => $commentaire->getId()
            ]);
        }
        return $this->render('blog/newPost.html.twig', [
            'commentaire' => $commentaire
        ]);
    }

    /**
     * @Route ("/affiche")
     *
     */
    public function afficheAction() {
        $em = $this->getDoctrine()->getManager()->find('BienBundle:Blog', 1);

        return $this->render('blog/newPost.html.twig', ['var' => $em]);
    }

}