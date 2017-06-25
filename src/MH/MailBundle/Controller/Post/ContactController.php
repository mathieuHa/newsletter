<?php

namespace MH\MailBundle\Controller\Post;


use MH\MailBundle\Form\Post\ContactType;
use MH\MailBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ContactController extends Controller
{

    public function addContactAdmissionAction(Request $request, $id)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
        $post = new Post("contact_admission", "Contact Admission", "");
        $contact = new Post\Contact();

        $form = $this
            ->get('form.factory')
            ->create(ContactType::class,$contact, array(
                'action' => $this->generateUrl('mh_mail_contact_add', array('id' => $id))));

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
            $post->setDescription($contact->getDescription());

            $mail->addPost($post);

            $em->persist($mail);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Contact Admission crée'
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

    public function editContactAdmissionAction(Request $request, $id)
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
