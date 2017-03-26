<?php

namespace MH\MailBundle\Controller\Post;


use MH\MailBundle\Entity\Post\BlocTexteImage;
use MH\MailBundle\Entity\Tool\Image;
use MH\MailBundle\Entity\Tool\Lien;
use MH\MailBundle\Entity\Tool\MiniTexte;
use MH\MailBundle\Entity\Tool\Texte;
use MH\MailBundle\Form\Post\BlocTexteImageType;
use MH\MailBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PhotoTexteController extends Controller
{
    public function addBlocAction(Request $request, $id)
    {
        $post = new Post();
        $post->setSlug("bloc_photo_texte");
        $blocTexteImage = new BlocTexteImage();
        $texte = new Texte();
        $miniTexte = new MiniTexte();
        $miniTexte->setTexte("5 raisons pour avoir plus de femmes dans le numérique");
        $lien = new Lien();
        $lien
            ->setAlt("ESIEA")
            ->setHref("esiea.fr")
            ->setTexte($miniTexte)
            ->setTarget(true);

        $blocTexteImage
            ->setTexte($texte)
            ->setTitre($lien);
        ;

        $post->setBlocphototexte($blocTexteImage);

        $form = $this
            ->get('form.factory')
            ->create(BlocTexteImageType::class,$blocTexteImage);


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
            $em->persist($mail);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Text photo créé'
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
        $bloc = $post->getBlocPhotoTexte();

        $form = $this
            ->get('form.factory')
            ->create(BlocTexteImageType::class,$bloc);

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
            'id'=>$mail_id,
            'post'=>$post,
        ));
    }



}
