<?php

namespace MH\MailBundle\Controller\Post;


use MH\MailBundle\Entity\Post\BlocTexteImage;
use MH\MailBundle\Entity\Tool\Lien;
use MH\MailBundle\Entity\Tool\MiniTexte;
use MH\MailBundle\Entity\Tool\Texte;
use MH\MailBundle\Form\Post\BlocTexteImageType;
use MH\MailBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PhotoTexteController extends Controller
{
    public function addBlocAction(Request $request, $id)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
        $post = new Post("bloc_photo_texte", "Bloc Photo Texte", "");
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
            ->create(BlocTexteImageType::class,$blocTexteImage, array(
                'action' => $this->generateUrl('mh_mail_bloc_photo_texte_add', array('id' => $id))));


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
            $post->setDescription($blocTexteImage->getDescription());

            $mail->addPost($post);

            $em->persist($mail);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Text photo créé'
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

    public function editBlocAction(Request $request, $id)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
        $post = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Post')
            ->find($id);

        $mail_id = $post->getMail()->getId();
        $bloc = $post->getBlocPhotoTexte();

        $form = $this
            ->get('form.factory')
            ->create(BlocTexteImageType::class,$bloc, array(
                'action' => $this->generateUrl('mh_mail_bloc_photo_texte_edit', array('id' => $id))));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this
                ->getDoctrine()
                ->getManager();
            $post->setDescription($bloc->getDescription());

            $em->persist($bloc);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Post Bloc modifiée'
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



}
