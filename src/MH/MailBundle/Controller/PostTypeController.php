<?php

namespace MH\MailBundle\Controller;


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

class PostTypeController extends Controller
{

    public function selectAction(Request $request, $id)
    {
        $listPostType = [
            new \MH\MailBundle\Entity\PostType(
                1,
                1,
                'Agenda Personnalisable',
                'Agenda',
                'agenda.JPG',
                'rendu d un agenda'
            ),
            new \MH\MailBundle\Entity\PostType(
                2,
                2,
                'Header, Footer, Img',
                'Header',
                'header.jpg',
                'Header emailling Esiea'
            ),
            new \MH\MailBundle\Entity\PostType(
                3,
                2,
                'Footer Admission',
                'Footer_admission',
                'footer_admission.JPG',
                'Footer emailling Esiea'
            ),
            new \MH\MailBundle\Entity\PostType(
                4,
                2,
                'Bloc Texte Couleur',
                'texte_separation',
                'texte_separation.JPG',
                'Texte separation Esiea'
            ),
            new \MH\MailBundle\Entity\PostType(
                5,
                2,
                'Bloc de Couleur',
                'bloc',
                'bloc.JPG',
                'Bloc Couleur'
            ),
            new \MH\MailBundle\Entity\PostType(
                6,
                2,
                'Bloc Photo et Texte',
                'bloc_photo_texte',
                'bloc_photo_texte.JPG',
                'Bloc Photo Texte'
            ),
        ];

        return $this->render('MHMailBundle:PostType:select.html.twig', array(
            'listPostType'=>$listPostType,
            'id'=>$id
        ));
    }

    public function orderAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
        if ($request->isMethod('POST') && $request->request->has('types') && is_array($types = $request->request->get('types'))) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('MHMailBundle:PostType');
            foreach ((array)$types as $i => $type_id) {
                $type = $repository->find($type_id);
                $type->setPosition($i);
            }
            $em->flush();
            return new JsonResponse(array(
                'status' => 'ok',
            ));
        } else {
            throw new BadRequestHttpException('No posts in request');
        }
    }
}
