<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BrandNewController extends AbstractController
{
    /**
     * @Route("/brand/new", name="brand_new")
     */
    public function index()
    {

        return $this->render('brand_new/index.html.twig', [
            'controller_name' => 'BrandNewController',
        ]);
    }
    /**
     * @Route("/hello", name="hello")
     */
    public function Hello()
    {
        //STORE STUFF IN THE DATABASE
        $post = new Post();
        $post->setTitle("tytol posta");
        $post->setDescription("opis_posta");

        $em = $this->getDoctrine()->getManager();

        $retreivedPost = $em->getRepository(Post::class)->findOneBy([
            'id' => 1
        ]);

        var_dump($retreivedPost);

        //create sql
        //$em->persist($post);
        //usuwanie rekordów
        //$em->remove($retreivedPost);

        //call it at the end
        $em->flush();

        $form = $this->createFormBuilder()
            ->add('id')
            ->add('email')
            ->getForm()
            ;

        return $this->render('base.html.twig', [
            'post'=>$retreivedPost,
            'form' => $form->createView()
    ]);
    }
}
