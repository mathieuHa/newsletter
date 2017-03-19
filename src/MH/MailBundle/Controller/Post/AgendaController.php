<?php

namespace MH\MailBundle\Controller\Post;


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

class AgendaController extends Controller
{

    public function addAgendaAction(Request $request, $id)
    {
        $post = new Post();
        $post->setSlug("agenda");
        $agenda = new Post\Agenda();
        $agenda
            ->setJour1("20")->setMois1("Janvier")
            ->setLien1("https://www.esiea.fr/admission-ecole-ingenieurs-concours-alpha-preparation/")
            ->setTextlien1("Concours Alpha")->setTexte1("Début des inscriptions sur APB")
            ->setJour2("12")->setMois2("Mars")
            ->setLien2("https://www.esiea.fr/les-dates-journees-portes-ouvertes/")
            ->setTextlien2("Journée Portes Ouverte")->setTexte2("Campus de Paris")
            ->setJour3("27")->setMois3("Février")
            ->setLien3("https://www.esiea.fr/les-dates-journees-portes-ouvertes/")
            ->setTextlien3("Journée Portes Ouverte")->setTexte3("Campus de Laval")
            ->setJour4("02")->setMois4("Mars")
            ->setLien4("https://www.esiea.fr/admission-ecole-ingenieurs-concours-alpha-preparation/")
            ->setTextlien4("Vis ma vie d'ingénieur")->setTexte4("1ère journée d'immersion sur le campus de Paris");
        $post->setAgenda($agenda);


        $form = $this
            ->get('form.factory')
            ->create(AgendaType::class,$agenda);

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
            $post->setAgenda($agenda);
            $mail->addPost($post);

            $em->persist($mail);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Agenda crée'
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



    public function editAgendaAction(Request $request, $id)
    {
        $post = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Post')
            ->find($id);

        $mail_id = $post->getMail()->getId();
        $agenda = $post->getAgenda();

        $form = $this
            ->get('form.factory')
            ->create(AgendaType::class,$agenda);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($agenda);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Agenda modifié'
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
