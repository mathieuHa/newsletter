<?php

namespace MH\NewsletterBundle\Controller;

use MH\NewsletterBundle\Entity\Newsletter;
use MH\NewsletterBundle\Entity\Post;
use MH\NewsletterBundle\Entity\Rubrique;
use MH\NewsletterBundle\Form\NewsletterType;
use MH\NewsletterBundle\Form\PostType;
use MH\NewsletterBundle\Form\RubriqueType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class PostController extends Controller
{
    public function edit2Action (Request $request, $id, $newsletter_id)
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
            $post->getRubrique()->getNewsletter()->updateDate();
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($post);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Newsletter mise à jour'
                );

            return $this->redirectToRoute('mh_newsletter_edit',array(
                'id'=>$newsletter_id
            ));
        }


        return $this->render('MHNewsletterBundle:Post:edit.html.twig', array(
            'form'=>$form->createView(),
            'post'=>$post,
            'id'=>$id,
            'newsletter_id'=>$newsletter_id
        ));

    }

    public function editAction(Request $request,  $id, $newsletter_id){
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
        $post = $this
            ->getDoctrine()
            ->getRepository('MHNewsletterBundle:Post')
            ->find($id);

        if (null === $post) {
            throw new NotFoundHttpException("Le Post ".$id." n'existe pas");
        }

        $form = $this
            ->get('form.factory')
            ->createNamed('mh_newsletterbundle_post_edit', PostType::class,$post, array(
                'action' => $this->generateUrl('mh_newsletter_post_edit', array('id' => $id, 'newsletter_id' => $newsletter_id))));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this
                ->getDoctrine()
                ->getManager();


            $em->persist($post);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Bloc Texte modifiée'
                );

            return new JsonResponse(array(
                'status' => 'ok',
                'id'=>$post->getId()
            ));
        }

        return $this->render('MHNewsletterBundle:Post:edit.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
            'post' => $post,
            'newsletter_id'=>$newsletter_id
        ));
    }


    public function addAction(Request $request, $id, $newsletter_id)
    {
        $post = new Post();
        $post->setTextelien('Lire');
        $form = $this
            ->get('form.factory')
            ->create(PostType::class,$post);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();
            $rubrique = $this
                ->getDoctrine()
                ->getRepository('MHNewsletterBundle:Rubrique')
                ->find($id);
            $rubrique->getNewsletter()->updateDate();
            $post->setPosition(0);
            $rubrique->addPost($post);

            $em->persist($rubrique);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post crée'
                );

            return $this->redirectToRoute('mh_newsletter_edit',array(
                'id'=>$newsletter_id
            ));
        }

        return $this->render('MHNewsletterBundle:Post:add.html.twig', array(
            'form'=>$form->createView(),
            'post'=>$post,
            'id'=>$newsletter_id,
        ));
    }

    public function deleteAction (Request $request, $id, $newsletter_id, $rubrique_id)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
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

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this
                ->getDoctrine()
                ->getManager();


            $post->getRubrique()->getNewsletter()->updateDate();
            $em->remove($post);
            $em->flush();

            $this->addFlash(
                'notice',
                'Post supprimé'
            );

            return new JsonResponse(array(
                'status' => 'ok',
                'id'=>$post->getId()
            ));
        }

        return $this
                ->render('MHNewsletterBundle:Post:delete.html.twig',array(
                'post'=>$post,
                'form'=>$form->createView(),
                'newsletter_id'=>$newsletter_id,
                'rubrique_id'=>$rubrique_id
            ));
    }

    public function orderAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
        if ($request->isMethod('POST') && $request->request->has('posts') && is_array($posts = $request->request->get('posts'))) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('MHNewsletterBundle:Post');
            foreach ((array)$posts as $i => $post_id) {
                $post = $repository->find($post_id);
                $post->setPosition($i);
            }
            $em->flush();
            return new JsonResponse(array(
                'status' => 'ok',
            ));
        } else {
            throw new BadRequestHttpException('No posts in request');
        }
    }
}
