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
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ButtonRedController extends Controller
{
    public function addButtonRedAction(Request $request, $id)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
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
            ->create(ButtonRedType::class,$button, array(
                'action' => $this->generateUrl('mh_mail_button_red_add', array('id' => $id))));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
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
            $this->getDoctrine()->getManager()->flush();
            return new JsonResponse(array(
                'status' => 'ok'
            ));
        }
        return $this->render('MHMailBundle:Post:edit-all.html.twig', array(
            'form' => $form->createView(),
            'id' => $id,
            'post' => $post,
        ));
    }

    public function editButtonRedAction(Request $request,$id)
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
                'action' => $this->generateUrl('mh_mail_button_red_edit', array('id' => $post->getId()))));
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




}
