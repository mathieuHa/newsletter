<?php

namespace MH\MailBundle\Controller\Header;


use MH\MailBundle\Form\Post\AgendaType;
use MH\MailBundle\Form\Post\HeaderType;
use MH\MailBundle\Form\Post\ImageType;
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

class HeaderController extends Controller
{
    public function addHeaderAction(Request $request, $id)
    {
        $post = new Post();
        $post->setSlug("header");
        $header = new Post\Header();
        $header->setImage(new Post\Image());
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

        return $this->render('MHMailBundle:PostType:header.html.twig', array(
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

        return $this->render('MHMailBundle:PostType:header.html.twig', array(
            'form'=>$form->createView(),
            'id'=>$id,
            'post'=>$post
        ));
    }

}
