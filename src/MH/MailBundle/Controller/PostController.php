<?php

namespace MH\MailBundle\Controller;


use MH\MailBundle\Form\PostType;
use MH\MailBundle\Entity\Post;
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

    public function editAction (Request $request, $id, $mail_id)
    {
        $post = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Post')
            ->find($id);

        $form = $this
            ->get('form.factory')
            ->create(PostType::class,$post);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $post->getMail()->updateDate();
            $em = $this
                ->getDoctrine()
                ->getManager();


            $em->persist($post);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post mis à jour'
                );

            return $this->redirectToRoute('mh_mail_edit',array(
                'id'=>$post->getMail()->getId()
            ));
        }


        return $this->render('MHMailBundle:Post:edit.html.twig', array(
            'form'=>$form->createView(),
            'post'=>$post,
            'id'=>$id,
            'mail_id'=>$mail_id
        ));

    }



    public function addAction(Request $request, $id)
    {
        $post = new Post();
        $form = $this
            ->get('form.factory')
            ->create(PostType::class,$post);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();
            $mail = $this
                ->getDoctrine()
                ->getRepository('MHMailBundle:Mail')
                ->find($id);
            $post->setPosition(0); // TEMPORAIRE A ENLEVER
            $mail->addPost($post);

            $em->persist($mail);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post crée'
                );

            return $this->redirectToRoute('mh_mail_edit',array(
                'id'=>$id
            ));
        }

        return $this->render('MHMailBundle:Post:add.html.twig', array(
            'form'=>$form->createView(),
            'post'=>$post,
            'id'=>$id
        ));
    }

    public function copyAction ($id)
    {
        $post = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Post')
            ->find($id);
        $new = clone $post;

        $em = $this->getDoctrine()->getManager();
        $em->persist($new);
        $em->flush();

        $this
            ->addFlash(
                'notice','Mail copiée'
            );

        return $this->redirectToRoute('mh_mail_home');
    }


    public function deleteAction (Request $request, $id, $mail_id)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $post = $em
            ->getRepository('MHMailBundle:Post')
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

            return $this->redirectToRoute('mh_mail_edit',array(
                'id'=>$mail_id
            ));
        }

        return $this
            ->render('MHMailBundle:Post:delete.html.twig',array(
                'post'=>$post,
                'id'=>$id,
                'mail_id'=>$mail_id,
                'form'=>$form->createView()
            ));
    }

    public function orderAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
        if ($request->isMethod('POST') && $request->request->has('posts') && is_array($posts = $request->request->get('posts'))) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('MHMailBundle:Post');
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
