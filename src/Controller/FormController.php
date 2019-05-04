<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    /**
     * @Route("/form", name="form")
     */
    public function index(Request $request)
    {
        //$post = new Post();
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Post::class)->findOneBy([
            'id' => 4
        ]);

        $form = $this->createForm(PostType::class, $post, [
            'action' => $this->generateUrl('form')
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            var_dump($post); die;
            //saving to the database


        }
        $em->remove($post);
        //$em->persist($post);
        $em->flush();
        return $this->render('form/index.html.twig', [
            'post_form' => $form->createView(),
        ]);
    }
}
