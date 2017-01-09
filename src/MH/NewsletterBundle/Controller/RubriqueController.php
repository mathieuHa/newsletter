<?php

namespace MH\NewsletterBundle\Controller;

use MH\NewsletterBundle\Entity\Newsletter;
use MH\NewsletterBundle\Entity\Post;
use MH\NewsletterBundle\Entity\Rubrique;
use MH\NewsletterBundle\Form\NewsletterType;
use MH\NewsletterBundle\Form\RubriqueType;
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

class RubriqueController extends Controller
{
    public function editAction (Request $request, $id, $newsletter_id)
    {
        $rubrique = $this
            ->getDoctrine()
            ->getRepository('MHNewsletterBundle:Rubrique')
            ->find($id);

        $form = $this
            ->get('form.factory')
            ->create(RubriqueType::class,$rubrique);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();


            $em->persist($rubrique);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Rubrique mise à jour'
                );

            return $this->redirectToRoute('mh_newsletter_edit',array(
                'id'=>$rubrique->getNewsletter()->getId()
            ));
        }


        return $this->render('MHNewsletterBundle:Rubrique:edit.html.twig', array(
            'form'=>$form->createView(),
            'rubrique'=>$rubrique,
            'id'=>$id,
            'newsletter_id'=>$newsletter_id
        ));

    }



    public function addAction(Request $request, $id)
    {
        $rubrique = new Rubrique();
        $form = $this
            ->get('form.factory')
            ->create(RubriqueType::class,$rubrique);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();
            $newsletter = $this
                ->getDoctrine()
                ->getRepository('MHNewsletterBundle:Newsletter')
                ->find($id);
            $rubrique->setPosition(0); // TEMPORAIRE A ENLEVER
            $newsletter->addRubrique($rubrique);

            $em->persist($newsletter);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Rubrique crée'
                );

            return $this->redirectToRoute('mh_newsletter_edit',array(
                'id'=>$id
            ));
        }

        return $this->render('MHNewsletterBundle:Rubrique:add.html.twig', array(
            'form'=>$form->createView(),
            'rubrique'=>$rubrique,
            'id'=>$id
        ));
    }

    public function deleteAction (Request $request, $id, $newsletter_id)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $rubrique = $em
            ->getRepository('MHNewsletterBundle:Rubrique')
            ->find($id);

        if (null === $rubrique) {
            throw new NotFoundHttpException("La Rubrique ".$id." n'existe pas");
        }

        $form = $this
            ->get('form.factory')
            ->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->remove($rubrique);
            $em->flush();

            $this->addFlash(
                'notice',
                'Rubrique supprimée'
            );

            return $this->redirectToRoute('mh_newsletter_edit',array(
                'id'=>$newsletter_id
            ));
        }

        return $this
            ->render('MHNewsletterBundle:Rubrique:delete.html.twig',array(
                'rubrique'=>$rubrique,
                'id'=>$id,
                'newsletter_id'=>$newsletter_id,
                'form'=>$form->createView()
            ));
    }

    public function orderAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
        if ($request->isMethod('POST') && $request->request->has('rubriques') && is_array($rubriques = $request->request->get('rubriques'))) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('MHNewsletterBundle:Rubrique');
            foreach ((array)$rubriques as $i => $rubrique_id) {
                $rubrique = $repository->find($rubrique_id);
                $rubrique->setPosition($i);
            }
            $em->flush();
            return new JsonResponse(array(
                'status' => 'ok',
            ));
        } else {
            throw new BadRequestHttpException('No posts in request');
        }
    }

    /* public function getAction(Request $request)
    {
        $id = $request->query->get('id');
        $newsletter = $this
            ->getDoctrine()
            ->getRepository('MHNewsletterBundle:Newsletter')
            ->find($id);
        $encoder = new JsonEncoder();
        $normalizer = new ObjectNormalizer();

        $normalizer->setCircularReferenceHandler(function ($newsletter) {
            return $newsletter->getName();
        });

        $serializer = new Serializer(array($normalizer), array($encoder));
        $json = $serializer->serialize($newsletter, 'json');
        return new Response($json);

    }*/
}
