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
        $post = new Post("button_red", "Bouton Action", "");
        $button = new ButtonRed();
        $button->setDescription("Bouton Action");
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
            $post->setPosition(100); // TEMPORAIRE A ENLEVER
            $post->setDescription($button->getDescription());
            $mail->addPost($post);
            $em->persist($mail);
            $em->flush();
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
            $post->setDescription($button->getDescription());
            $this->getDoctrine()->getManager()->flush();
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
