<?php

namespace MH\NewsletterBundle\Controller;

use MH\NewsletterBundle\Entity\Newsletter;
use MH\NewsletterBundle\Entity\Post;
use MH\NewsletterBundle\Entity\Rubrique;
use MH\NewsletterBundle\Form\NewsletterType;
use MH\NewsletterBundle\Form\RubriqueType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class RubriqueController extends Controller
{
    public function editAction (Request $request, $id)
    {
        $rubrique = $this
            ->getDoctrine()
            ->getRepository('MHNewsletterBundle:Newsletter')
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

            return $this->redirectToRoute('mh_rubrique_edit',array(
                'id'=>$id
            ));
        }


        return $this->render('MHNewsletterBundle:Rubrique:edit.html.twig', array(
            'form'=>$form->createView(),
            'rubrique'=>$rubrique,
        ));

    }

    public function getAction(Request $request)
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

    }

    public function addAction(Request $request)
    {

    }

    public function deleteAction (Request $request, $id)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $rubrique = $this
            ->getDoctrine()
            ->getRepository('MHNewsletterBundle:Rubrique')
            ->find($id);

        if (null === $rubrique) {
            throw new NotFoundHttpException("La Rubrique ".$id." n'existe pas");
        }

        $form = $this
            ->get('form.factory')
            ->create();
        /* la suppression des rubriques n'est pas fonctionnelle*/
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->remove($rubrique);
            $em->flush();

            $this->addFlash(
                'notice',
                'Rubrique supprimée'
            );

            return $this->redirectToRoute('mh_newsletter_home');
        }

        return $this
            ->render('MHNewsletterBundle:Rubrique:delete.html.twig',array(
                'rubrique'=>$rubrique,
                'form'=>$form->createView()
            ));
    }
}
