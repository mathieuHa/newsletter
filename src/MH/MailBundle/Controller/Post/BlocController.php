<?php

namespace MH\MailBundle\Controller\Post;


use MH\MailBundle\Form\Post\BlocType;
use MH\MailBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BlocController extends Controller
{
    public function addBlocAction(Request $request, $id)
    {
        $post = new Post();
        $post->setSlug("bloc");
        $post->setName("Bloc de Couleur");
        $bloc = new Post\Bloc();
        $bloc->setDescription("Bloc de Couleur");
        $post->setBloc($bloc);
        $bloc
            ->setHauteur("15");

        $form = $this
            ->get('form.factory')
            ->create(BlocType::class,$bloc, array(
                'action' => $this->generateUrl('mh_mail_bloc_add', array('id' => $id))));


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
            $em->persist($mail);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Bloc créé'
                );
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
            ->create(BlocType::class,$bloc, array(
                'action' => $this->generateUrl('mh_mail_bloc_edit', array('id' => $id))));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($bloc);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Bloc modifiée'
                );
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



}
