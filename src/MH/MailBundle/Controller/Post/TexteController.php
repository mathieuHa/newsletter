<?php

namespace MH\MailBundle\Controller\Post;


use MH\MailBundle\Entity\Tool\Texte;
use MH\MailBundle\Form\Post\TexteType;
use MH\MailBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TexteController extends Controller
{
    public function addTexteAction(Request $request, $id)
    {
        $post = new Post();
        $post->setSlug("texte_separation");
        $texte = new Post\Texte();
        $text = new Texte();
        $texte
            ->setTexte($text)
            ->setHauteur("15");
        $post->setTexte($texte);

        $form = $this
            ->get('form.factory')
            ->create(TexteType::class,$texte);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();
            $mail = $this
                ->getDoctrine()
                ->getRepository('MHMailBundle:Mail')
                ->find($id);
            $em->persist($texte);
            $post->setPosition(100); // TEMPORAIRE A ENLEVER
            $mail->addPost($post);
            $post->setTexte($texte);
            $em->persist($mail);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Texte séparation crée'
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

    public function editTexteAction(Request $request, $id)
    {
        $post = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Post')
            ->find($id);

        $mail_id = $post->getMail()->getId();
        $texte = $post->getTexte();

        $form = $this
            ->get('form.factory')
            ->create(TexteType::class,$texte);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($texte);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Texte séparation modifiée'
                );

            return $this->redirectToRoute('mh_mail_edit',array(
                'id'=>$mail_id
            ));
        }

        return $this->render('MHMailBundle:PostType:'.$post->getSlug().'.html.twig', array(
            'form'=>$form->createView(),
            'id'=>$id,
            'post'=>$post,
        ));
    }



}
