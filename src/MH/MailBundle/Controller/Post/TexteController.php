<?php

namespace MH\MailBundle\Controller\Post;


use MH\MailBundle\Entity\Tool\Texte;
use MH\MailBundle\Form\Post\TexteType;
use MH\MailBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TexteController extends Controller
{
    public function addTexteAction(Request $request, $id)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
        $post = new Post("texte_separation", "Texte de Séparation", "");
        $texte = new Post\Texte();
        $text = new Texte();
        $texte
            ->setTexte($text)
            ->setHauteur("15");
        $post->setTexte($texte);

        $form = $this
            ->get('form.factory')
            ->create(TexteType::class,$texte, array(
                'action' => $this->generateUrl('mh_mail_texte_separation_add', array('id' => $id))));

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
            $mail->addPost($post);
            $post->setTexte($texte);
            $post->setDescription($texte->getDescription());
            $em->persist($texte);
            $em->persist($mail);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Texte séparation crée'
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

    public function editTexteAction(Request $request, $id)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
        $post = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Post')
            ->find($id);

        $mail_id = $post->getMail()->getId();
        $texte = $post->getTexte();

        $form = $this
            ->get('form.factory')
            ->create(TexteType::class,$texte, array(
                'action' => $this->generateUrl('mh_mail_texte_separation_edit', array('id' => $id))));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this
                ->getDoctrine()
                ->getManager();
            $post->setDescription($texte->getDescription());

            $em->persist($texte);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Texte séparation modifiée'
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
