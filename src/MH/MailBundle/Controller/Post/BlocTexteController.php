<?php

namespace MH\MailBundle\Controller\Post;


use MH\MailBundle\Entity\Tool\Texte;
use MH\MailBundle\Form\Post\BlocTexteType;
use MH\MailBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlocTexteController extends Controller
{
    public function addBlocTexteAction(Request $request, $id)
    {
        $post = new Post();
        $post->setSlug("bloc_texte");
        $blocTexte = new Post\BlocTexte();
        $text = new Texte();
        $blocTexte
            ->setTexte($text);
        $post->setBlocTexte($blocTexte);

        $form = $this
            ->get('form.factory')
            ->create(BlocTexteType::class,$blocTexte);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();
            $mail = $this
                ->getDoctrine()
                ->getRepository('MHMailBundle:Mail')
                ->find($id);
            $em->persist($blocTexte);
            $post->setPosition(100); // TEMPORAIRE A ENLEVER
            $mail->addPost($post);
            $post->setBloctexte($blocTexte);
            $em->persist($mail);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Bloc Texte créé'
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

    public function editBlocTexteAction(Request $request, $id)
    {
        $post = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Post')
            ->find($id);

        $mail_id = $post->getMail()->getId();
        $blocTexte = $post->getBlocTexte();

        $form = $this
            ->get('form.factory')
            ->create(BlocTexteType::class,$blocTexte);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($blocTexte);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Bloc Texte modifiée'
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
