<?php

namespace MH\MailBundle\Controller\Post;

use MH\MailBundle\Entity\Post\ButtonRed;
use MH\MailBundle\Entity\Tool\Couleur;
use MH\MailBundle\Entity\Tool\Lien;
use MH\MailBundle\Entity\Tool\MiniTexte;
use MH\MailBundle\Entity\Tool\Police;
use MH\MailBundle\Form\Post\ButtonRedType;
use MH\MailBundle\Form\Post\TexteType;
use MH\MailBundle\Entity\Post;
use MH\MailBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ButtonRedController extends Controller
{
    public function addButtonRedAction(Request $request, $id)
    {
        $post = new Post();
        $post->setSlug("button_red");
        $post->setName("Bouton Action");
        $button = new ButtonRed();
        $button->setDescription("Description ...");
        $texte = new MiniTexte();
        //$police = new Police(null, 14);
        $texte
            ->setTexte("En savoir plus");
        $lien = new Lien();
        $lien
            ->setHref("https://www.esiea.fr/")
            ->setAlt("ESIEA Ecole d'ingénieur du monde Numérique")
            ->setTarget(true)
            ->setTexte($texte);
        $button
            ->setHauteur("15");
        $button->setLien($lien);
        $post->setButtonRed($button);

        $form = $this
            ->get('form.factory')
            ->create(ButtonRedType::class,$button);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this
                ->getDoctrine()
                ->getManager();
            $mail = $this
                ->getDoctrine()
                ->getRepository('MHMailBundle:Mail')
                ->find($id);
            $em->persist($button);
            $post->setPosition(100); // TEMPORAIRE A ENLEVER
            $mail->addPost($post);
            $post->setButtonRed($button);
            $em->persist($mail);
            $em->flush();

            $this
                ->addFlash(
                    'notice', 'Post Bouton Rouge crée'
                );
            return $this->redirectToRoute('mh_mail_edit',array(
                'id'=>$id
            ));
        }
        return $this->render('MHMailBundle:PostType:' . $post->getSlug() . '.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
            'post' => $post,
        ));
    }

    public function editXButtonRedAction(Request $request,$id)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
        $post = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Post')
            ->find($id);
        //$mail_id = $post->getMail()->getId();
        $button = $post->getButtonRed();
        $form = $this
            ->get('form.factory')
            ->create(ButtonRedType::class,$button, array(
                'action' => $this->generateUrl('mh_mail_button_red_edit_x', array('id' => $post->getId()))));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return new JsonResponse(array(
                'status' => 'ok'
            ));
        }
        return $this->render('MHMailBundle:Post:edit-all.html.twig', array(
            'form'=>$form->createView(),
            //'id'=>$id,
            'post'=>$post
        ));
    }

    public function editButtonRedAction(Request $request, $id)
    {
        $post = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Post')
            ->find($id);

        $mail_id = $post->getMail()->getId();
        $button = $post->getButtonRed();

        $form = $this
            ->get('form.factory')
            ->create(ButtonRedType::class,$button);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($button);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post bouton rouge modifiée'
                );

            return $this->render('MHMailBundle:PostType:'.$post->getSlug().'.html.twig', array(
                'form'=>$form->createView(),
                'id'=>$mail_id,
                'post'=>$post,
            ));
        }

        return $this->render('MHMailBundle:PostType:'.$post->getSlug().'.html.twig', array(
            'form'=>$form->createView(),
            'id'=>$mail_id,
            'post'=>$post,
        ));
    }



}
