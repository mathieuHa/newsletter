<?php

namespace MH\MailBundle\Controller\Post;


use MH\MailBundle\Entity\Tool\Lien;
use MH\MailBundle\Form\Post\AgendaType;
use MH\MailBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AgendaController extends Controller
{

    public function addAgendaAction(Request $request, $id)
    {
        $post = new Post();
        $post->setSlug("agenda");
        $agenda = new Post\Agenda();
        $agenda
            ->setJour1("20")->setMois1("Janvier")
            ->setTexte1("Début des inscriptions sur APB")
            ->setJour2("12")->setMois2("Mars")
            ->setTexte2("Campus de Paris")
            ->setJour3("27")->setMois3("Février")
            ->setTexte3("Campus de Laval")
            ->setJour4("02")->setMois4("Mars")
            ->setTexte4("1ère journée d'immersion sur le campus de Paris");
        $lien1 = new Lien();
        $lien1
            ->setHref("https://www.esiea.fr/admission-ecole-ingenieurs-concours-alpha-preparation/")
            ->setAlt("admission préparation au concours alpha")
            ->setTexte("Concours Alpha")
            ->setTarget(true);
        $lien2 = new Lien();
        $lien2
            ->setHref("https://www.esiea.fr/les-dates-journees-portes-ouvertes/")
            ->setAlt("Journées Portes-Ouvertes ESIEA")
            ->setTexte("Journée Portes Ouverte")
            ->setTarget(true);
        $lien3 = new Lien();
        $lien3
            ->setHref("https://www.esiea.fr/les-dates-journees-portes-ouvertes/")
            ->setAlt("Journées Portes-Ouvertes ESIEA")
            ->setTexte("Journée Portes Ouverte")
            ->setTarget(true);
        $lien4 = new Lien();
        $lien4
            ->setHref("https://www.esiea.fr/admission-ecole-ingenieurs-concours-alpha-preparation/")
            ->setAlt("Vie Ma Vie d'ingénieur")
            ->setTexte("Vis ma vie d'ingénieur")
            ->setTarget(true);
        $agenda->getLiens()
            ->add($lien1);
        $agenda->getLiens()
            ->add($lien2);
        $agenda->getLiens()
            ->add($lien3);
        $agenda->getLiens()
            ->add($lien4);
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
