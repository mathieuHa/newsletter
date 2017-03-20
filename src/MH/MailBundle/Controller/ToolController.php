<?php

namespace MH\MailBundle\Controller;

use MH\MailBundle\Entity\Tool\Couleur;
use MH\MailBundle\Form\MailType;
use MH\MailBundle\Form\Tool\CouleurType;
use MH\MailBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class ToolController extends Controller
{
    public function indexAction()
    {
        return $this->render('MHMailBundle:Tool:index.html.twig');
    }

    public function addCouleurAction (Request $request)
    {
        $couleur = new Couleur();
        $couleur
            ->setNom("Nouvelle Couleur")
            ->setvaleur("000000");

        $form = $this
            ->get('form.factory')
            ->create(CouleurType::class,$couleur);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($couleur);
            $em->flush();

            $this
               ->addFlash(
                  'notice','Couleur créé'
              );

            return $this->redirectToRoute('mh_mail_couleur_view');
        }

        return $this->render('MHMailBundle:Tool\Couleur:add.html.twig', array(
            'form'=>$form->createView(),
        ));
    }

    public function viewCouleurAction ()
    {
        $listCouleur = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Tool\Couleur')
            ->findAll();
        return $this->render('MHMailBundle:Tool\Couleur:view.html.twig',array(
            'listCouleur'=>$listCouleur
        ));
    }

    public function editCouleurAction (Request $request, $id)
    {
        $couleur = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Tool\Couleur')
            ->find($id);

        $form = $this
            ->get('form.factory')
            ->create(CouleurType::class,$couleur);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($couleur);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Couleur modifié'
                );

            return $this->redirectToRoute('mh_mail_couleur_view');
        }

        return $this->render('MHMailBundle:Tool\Couleur:edit.html.twig', array(
            'id'=>$couleur->getId(),
            'form'=>$form->createView()
        ));
    }

    public function deleteCouleurAction (Request $request, $id)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $couleur = $em
            ->getRepository('MHMailBundle:Tool\Couleur')
            ->find($id);

        if (null === $couleur) {
            throw new NotFoundHttpException("La Couleur ".$id." n'existe pas");
        }

        $form = $this
            ->get('form.factory')
            ->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->remove($couleur);
            $em->flush();

            $this->addFlash(
                'notice',
                'Couleur supprimée'
            );

            return $this->redirectToRoute('mh_mail_couleur_view');
        }

        return $this
            ->render('MHMailBundle:Tool\Couleur:delete.html.twig',array(
                'id'=>$couleur->getId(),
                'form'=>$form->createView()
            ));
    }

}