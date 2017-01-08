<?php

namespace MH\NewsletterBundle\Controller;

use MH\NewsletterBundle\Entity\Newsletter;
use MH\NewsletterBundle\Entity\Post;
use MH\NewsletterBundle\Entity\Rubrique;
use MH\NewsletterBundle\Form\NewsletterType;
use MH\NewsletterBundle\Form\RubriqueType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class PostController extends Controller
{
    public function editAction (Request $request, $id)
    {
        $post = $this
            ->getDoctrine()
            ->getRepository('MHNewsletterBundle:Post')
            ->find($id);
        $form = $this
            ->get('form.factory')
            ->create(PostType::class,$post);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($post);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Newsletter mise à jour'
                );

            return $this->redirectToRoute('mh_post_edit',array(
                'id'=>$id
            ));
        }


        return $this->render('MHNewsletterBundle:Post:edit.html.twig', array(
            'form'=>$form->createView(),
            'post'=>$post,
        ));

    }


    public function addAction(Request $request)
    {

    }

    public function deleteAction (Request $request, $id)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $post = $this
            ->getDoctrine()
            ->getRepository('MHNewsletterBundle:Post')
            ->find($id);

        if (null === $post) {
            throw new NotFoundHttpException("Le Post ".$id." n'existe pas");
        }

        $form = $this
            ->get('form.factory')
            ->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->remove($post);
            $em->flush();

            $this->addFlash(
                'notice',
                'Post supprimé'
            );

            return $this->redirectToRoute('mh_newsletter_home');
        }

        return $this
            ->render('MHNewsletterBundle:Post:delete.html.twig',array(
                'post'=>$post,
                'form'=>$form->createView()
            ));
    }
}
