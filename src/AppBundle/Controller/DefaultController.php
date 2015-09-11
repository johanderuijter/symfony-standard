<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // put some stuff in the db
        $manager = $this->getDoctrine()->getManager();
        $article = new Article();
        $manager->persist($article);
        $article = new Article();
        $manager->persist($article);
        $manager->flush();


        $form = $this->createForm(new ArticleType(), array(), array(
            'repository' => $manager->getRepository('AppBundle\Entity\Article'),
        ));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $manager->persist($article);
            $manager->flush();
        }

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'form' => $form->createView(),
        ));
    }
}
