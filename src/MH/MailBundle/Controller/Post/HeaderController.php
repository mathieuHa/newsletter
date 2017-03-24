<?php

namespace MH\MailBundle\Controller\Post;


use MH\MailBundle\Form\Post\HeaderType;
use MH\MailBundle\Entity\Post;
use MH\MailBundle\Entity\Tool;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HeaderController extends Controller
{
    public function addHeaderAction(Request $request, $id)
    {
        $post = new Post();
        $post->setSlug("header");
        $header = new Post\Header();
        $header->setImage(new Tool\Image());
        $header->getImage()
            ->setSrc("https://www.esiea.fr/wp-content/uploads/2016/11/Header-emailling_02.jpg")
            ->setAlt("ESIEA, l'&Eacute;cole d'ing&eacute;nieurs du monde num&eacute;rique")
            ->setDescription("ESIEA, l'&Eacute;cole d'ing&eacute;nieurs du monde num&eacute;rique")
        ;

        $form = $this
            ->get('form.factory')
            ->create(HeaderType::class,$header);

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
            $post->setHeader($header);
            $mail->addPost($post);

            $em->persist($mail);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Header crée'
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

    public function editHeaderAction(Request $request, $id)
    {
        $post = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Post')
            ->find($id);

        $mail_id = $post->getMail()->getId();
        $header = $post->getHeader();

        $form = $this
            ->get('form.factory')
            ->create(HeaderType::class,$header);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($header);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Header modifié'
                );

            return $this->redirectToRoute('mh_mail_edit',array(
                'id'=>$mail_id
            ));
        }

        return $this->render('MHMailBundle:PostType:'.$post->getSlug().'.html.twig', array(
            'form'=>$form->createView(),
            'id'=>$id,
            'post'=>$post
        ));
    }

}
