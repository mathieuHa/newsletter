<?php

namespace MH\MailBundle\Controller\Post;


use Doctrine\ORM\Mapping\Entity;
use MH\MailBundle\Entity\Tool\Couleur;
use MH\MailBundle\Form\Post\AgendaType;
use MH\MailBundle\Form\Post\BlocType;
use MH\MailBundle\Form\Post\FooterType;
use MH\MailBundle\Form\Post\HeaderType;
use MH\MailBundle\Form\Post\ImageType;
use MH\MailBundle\Form\Post\TexteType;
use MH\MailBundle\Form\PostType;
use MH\MailBundle\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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

class BlocController extends Controller
{
    public function addBlocAction(Request $request, $id)
    {
        $post = new Post();
        $post->setSlug("bloc");
        $bloc = new Post\Bloc();
        $post->setBloc($bloc);
        $bloc
            ->setHauteur("15");

        $form = $this
            ->get('form.factory')
            ->create(BlocType::class,$bloc);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();
            $mail = $this
                ->getDoctrine()
                ->getRepository('MHMailBundle:Mail')
                ->find($id);
            $post->setPosition(100); // TEMPORAIRE A ENLEVER
            $mail->addPost($post);
            $post->setBloc($bloc);
            $em->persist($bloc);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Bloc créé'
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

    public function editBlocAction(Request $request, $id)
    {
        $post = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Post')
            ->find($id);

        $mail_id = $post->getMail()->getId();
        $bloc = $post->getBloc();

        $form = $this
            ->get('form.factory')
            ->create(BlocType::class,$bloc);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($bloc);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Bloc modifiée'
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
