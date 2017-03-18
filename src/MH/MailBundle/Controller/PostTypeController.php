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
                'Agenda',
                'agenda.JPG',
                'rendu d un agenda'
            ),
            new \MH\MailBundle\Entity\PostType(
                'Header',
                'Header-emailling_02.JPG',
                'Header emailling Esiea'
            ),
            new \MH\MailBundle\Entity\PostType(
                'Footer_admission',
                'Footer_admission.JPG',
                'Footer emailling Esiea'
            ),
            new \MH\MailBundle\Entity\PostType(
                'texte_separation',
                'texte_separation.JPG',
                'Texte separation Esiea'
            ),
        ];

        return $this->render('MHMailBundle:PostType:select.html.twig', array(
            'listPostType'=>$listPostType,
            'id'=>$id
        ));
    }

}
