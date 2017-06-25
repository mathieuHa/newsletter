<?php

namespace MH\MailBundle\Controller\Post;


use MH\MailBundle\Form\Post\FooterType;
use MH\MailBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FooterController extends Controller
{

    public function addFooterAdmissionAction(Request $request, $id)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
        $post = new Post("footer_admission", "Footer Admission", "");
        $footer = new Post\Footer();

        $form = $this
            ->get('form.factory')
            ->create(FooterType::class,$footer, array(
                'action' => $this->generateUrl('mh_mail_footer_add', array('id' => $id))));

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
            $post->setDescription($footer->getDescription());

            $mail->addPost($post);

            $em->persist($mail);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Footer Admission crée'
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

    public function editFooterAdmissionAction(Request $request, $id)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
        $post = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Post')
            ->find($id);

        $mail_id = $post->getMail()->getId();

        $this
            ->addFlash(
                'notice','On ne peux pas modifier ce bloc, Suppression autorisée'
            );

        return new JsonResponse(array(
            'status' => 'ok',
            'id'=>$post->getId()
        ));

    }
}
