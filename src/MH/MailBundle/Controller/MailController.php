<?php

namespace MH\MailBundle\Controller;

use MH\MailBundle\Entity\Mail;
use MH\MailBundle\Entity\User;
use MH\MailBundle\Form\MailType;
use MH\MailBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class MailController extends Controller
{
    public function indexAction()
    {
        $listMail= $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Mail')
            ->findAll();

        return $this->render('MHMailBundle:Mail:index.html.twig', array(
            'listMail'=>$listMail
        ));
    }

    public function createAction (Request $request)
    {
        $mail = new Mail();
        $mail
            ->setName("un mail")
            ->setPosition(0);

        $form = $this
            ->get('form.factory')
            ->create(MailType::class,$mail);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($mail);
            $em->flush();

            $this
               ->addFlash(
                  'notice','Mail crée'
              );

            return $this->redirectToRoute('mh_mail_edit',array(
                'id'=>$mail->getId()
            ));
        }

        return $this->render('MHMailBundle:Mail:create.html.twig', array(
            'form'=>$form->createView(),
            '$mail'=>$mail,
        ));
    }

    public function viewAction ($id)
    {
        $mail = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Mail')
            ->find($id);
        return $this->render('MHMailBundle:Template:mail.html.twig',array(
            'mail'=>$mail
        ));
    }

    public function downloadAction ($id)
    {
        $mail = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Mail')
            ->find($id);
        $file = $this->renderView('MHMailBundle:Template:mail.html.twig',array(
            'mail'=>$mail
        ));

        $response = new Response($file);
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/plain');

        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            "'mail_'.$mail->getName().'_'.$mail->getAuteur().'.html'"
        );
        $response->headers->set('Content-Disposition', $disposition);
        return $response;
    }



    public function editAction ($id)
    {
        $mail = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Mail')
            ->find($id);

        return $this->render('MHMailBundle:Mail:edit.html.twig', array(
            'mail'=>$mail,
        ));
    }

    public function copyAction ($id)
    {
        $mail = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Mail')
            ->find($id);
        $new = clone $mail;
        $new->setName($mail->getName().' copie');
        $new->setDate(new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($new);
        $em->flush();

        $this
            ->addFlash(
                'notice','Mail copiée'
            );

        return $this->redirectToRoute('mh_mail_home');
    }

    public function editHeaderAction (Request $request, $id)
    {
        $mail = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Mail')
            ->find($id);
        $form = $this
            ->get('form.factory')
            ->create(MailType::class,$mail);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $mail->udpateDate();
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($mail);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Mail mis à jour'
                );

            return $this->redirectToRoute('mh_mail_edit',array(
                'id'=>$mail->getId()
            ));
        }

        return $this->render('MHMailBundle:Mail:edit-header.html.twig', array(
            'form'=>$form->createView(),
            'mail'=>$mail,
        ));

    }

    public function getAction(Request $request)
    {
        $id = $request->query->get('id');
        $mail = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Mail')
            ->find($id);
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $normalizer->setCircularReferenceHandler(function ($mail) {
            return $mail->getName();
        });

        $serializer = new Serializer(array($normalizer), array($encoder));
        $json = $serializer->serialize($mail, 'json');
        return new Response($json);

    }

    public function deleteAction (Request $request, $id)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $mail = $em
            ->getRepository('MHMailBundle:Mail')
            ->find($id);

        if (null === $mail) {
            throw new NotFoundHttpException("Le mail ".$id." n'existe pas");
        }

        $form = $this
            ->get('form.factory')
            ->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->remove($mail);
            $em->flush();

            $this->addFlash(
                'notice',
                'Mail supprimé'
            );

            return $this->redirectToRoute('mh_mail_home');
        }

        return $this
            ->render('MHMailBundle:Mail:delete.html.twig',array(
                'mail'=>$mail,
                'form'=>$form->createView()
            ));
    }

    public function mailAction (Request $request, $id)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $mail = $em
            ->getRepository('MHMailBundle:Mail')
            ->find($id);

        if (null === $mail) {
            throw new NotFoundHttpException("Le mail ".$id." n'existe pas");
        }

        $user = new User();
        $user->setMail('hanotaux@et.esiea.fr')->setNom('Mathieu');

        $form = $this
            ->get('form.factory')
            ->create(UserType::class,$user);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $message = \Swift_Message::newInstance()
                ->setSubject('Email HTML Test')
                ->setFrom('hanotaux@et.esiea.fr')
                ->setTo($user->getMail())
                ->setBody(
                    $this->renderView(
                    // app/Resources/views/Emails/registration.html.twig
                        'MHMailBundle:Template:mail.html.twig',
                        array('mail' => $mail)
                    ),
                    'text/html'
                )

            ;
            $this->get('mailer')->send($message);

            $this->addFlash(
                'notice',
                'Mail envoyé à '.$user->getMail()
            );

            return $this->redirectToRoute('mh_mail_home');
        }

        return $this
            ->render('MHMailBundle:Mail:mail.html.twig',array(
                'mail'=>$mail,
                'user'=>$user,
                'form'=>$form->createView()
            ));
    }

    public function orderAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
        if ($request->isMethod('POST') && $request->request->has('mails') && is_array($mails = $request->request->get('mails'))) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('MHMailBundle:Mail');
            foreach ((array)$mails as $i => $mail_id) {
                $mail = $repository->find($mail_id);
                $mail->setPosition($i);
            }
            $em->flush();
            return new JsonResponse(array(
                'status' => 'ok',
            ));
        } else {
            throw new BadRequestHttpException('No Mail in request');
        }
    }
}
