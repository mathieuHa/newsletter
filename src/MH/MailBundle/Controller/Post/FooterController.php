<?php

namespace MH\MailBundle\Controller\Post;


use MH\MailBundle\Form\Post\FooterType;
use MH\MailBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FooterController extends Controller
{

    public function addFooterAdmissionAction(Request $request, $id)
    {
        $post = new Post();
        $post->setSlug("footer_admission");
        $footer = new Post\Footer();

        $form = $this
            ->get('form.factory')
            ->create(FooterType::class,$footer);

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
                    'notice','Post Footer Admission crée'
                );

            return $this->redirectToRoute('mh_mail_edit',array(
                'id'=>$id
            ));
        }

        return $this->render('MHMailBundle:PostType:'.$post->getSlug().'.html.twig', array(
            'form'=>$form->createView(),
            'id'=>$id,
            'post'=>$post,
        ));
    }

    public function editFooterAdmissionAction(Request $request, $id)
    {
        $post = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Post')
            ->find($id);

        $mail_id = $post->getMail()->getId();

        $this
            ->addFlash(
                'notice','On ne peux pas modifier ce bloc, Suppression autorisée'
            );

            return $this->redirectToRoute('mh_mail_edit',array(
                'id'=>$mail_id
            ));

    }
}
