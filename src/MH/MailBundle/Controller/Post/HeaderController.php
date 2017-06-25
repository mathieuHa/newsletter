<?php

namespace MH\MailBundle\Controller\Post;


use MH\MailBundle\Form\Post\HeaderType;
use MH\MailBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class HeaderController extends Controller
{
    public function addHeaderAction(Request $request, $id)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }

        $post = new Post("header", "Header", "");
        $header = new Post\Header();
        $post->setHeader($header);



        $form = $this
            ->get('form.factory')
            ->create(HeaderType::class,$header, array(
                'action' => $this->generateUrl('mh_mail_header_add', array('id' => $id))));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this
                ->getDoctrine()
                ->getManager();
            $mail = $this
                ->getDoctrine()
                ->getRepository('MHMailBundle:Mail')
                ->find($id);
            $post->setPosition(100); // TEMPORAIRE A ENLEVER
            $post->setHeader($header);
            $mail->addPost($post);
            $em->persist($mail);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Header crée'
                );

            return new JsonResponse(array(
                'status' => 'ok',
                'id'=>$post->getId()
            ));
        }

        return $this->render('MHMailBundle:Post:edit-all.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
            'post' => $post,
        ));
    }

    public function editHeaderAction(Request $request, $id)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }

        $post = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Post')
            ->find($id);

        $mail_id = $post->getMail()->getId();
        $header = $post->getHeader();

        $form = $this
            ->get('form.factory')
            ->create(HeaderType::class,$header, array(
                'action' => $this->generateUrl('mh_mail_header_edit', array('id' => $id))));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this
                ->getDoctrine()
                ->getManager();
            $post->setDescription($header->getDescription());


            $em->persist($header);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Header modifié'
                );

            return new JsonResponse(array(
                'status' => 'ok',
                'id'=>$post->getId()
            ));
        }

        return $this->render('MHMailBundle:Post:edit-all.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
            'post' => $post,
        ));
    }

}
