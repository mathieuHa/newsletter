<?php

namespace MH\MailBundle\Controller\Post;


use Doctrine\ORM\Mapping\Entity;
use MH\MailBundle\Entity\Post\BlocTexteImage;
use MH\MailBundle\Entity\Tool\Couleur;
use MH\MailBundle\Form\Post\AgendaType;
use MH\MailBundle\Form\Post\BlocTexteImageType;
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

class PhotoTexteController extends Controller
{
    public function addBlocAction(Request $request, $id)
    {
        $post = new Post();
        $post->setSlug("bloc_photo_texte");
        $blocTexteImage = new BlocTexteImage();

        $blocTexteImage
            ->setImage(new Post\Image())
            ->setCouleurTexte("000000")
            ->setTexte("Le 8 mars dernier, la journée internationale 
            des droits des Femmes a été cette année encore l’occasion 
            de se mobiliser collectivement pour lutter contre des 
            inégalités persistantes entre les hommes et les femmes, 
            en particulier sur le plan professionnel.
            Parce qu’il ne suffit pas d’une seule journée, l’ESIEA
             s’engage aux côtés de la Conférence des Grandes Ecoles 
             (CGE) et de l’association Elles Bougent pour faire
              progresser le nombre d’ingénieures formées en France,
               notamment dans le secteur du numérique. Fatiha Gas,
                Directrice du campus de Paris de l’ESIEA, en explique
                 les raisons, dans une tribune publiée dans le JDN (Journal Du Net).")
            ->setTitre("5 raisons pour avoir plus de femmes dans le numérique")
            ->setLien("https://www.esiea.fr/")
            ->setAltLien("ESIEA")
            ->setCouleurFond("ffffff");
        ;
        $blocTexteImage->getImage()
            ->setSrc("http://oscar-campus.com/doc/1420/image/newsletter%20mars/femme%20numerique.jpg")
            ->setAlt("ESIEA, l'&Eacute;cole d'ing&eacute;nieurs du monde num&eacute;rique")
            ->setDescription("ESIEA, l'&Eacute;cole d'ing&eacute;nieurs du monde num&eacute;rique");

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
