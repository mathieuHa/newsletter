<?php

namespace MH\NewsletterBundle\Controller;

use MH\NewsletterBundle\Entity\Newsletter;
use MH\NewsletterBundle\Entity\Post;
use MH\NewsletterBundle\Entity\Rubrique;
use MH\NewsletterBundle\Entity\User;
use MH\NewsletterBundle\Form\NewsletterType;
use MH\NewsletterBundle\Form\RubriqueType;
use MH\NewsletterBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class DocumentationController extends Controller
{
    public function viewAction(){
        return $this->render('MHNewsletterBundle:Documentation:index.html.twig');
    }

}
