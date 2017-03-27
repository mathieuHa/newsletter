<?php

namespace MH\MailBundle\Controller;

use MH\MailBundle\Entity\PostType;
use MH\MailBundle\Entity\Tool\Couleur;
use MH\MailBundle\Entity\Tool\Image;
use MH\MailBundle\Entity\Tool\Police;
use MH\MailBundle\Form\PostTypeType;
use MH\MailBundle\Form\Tool\CouleurType;
use MH\MailBundle\Form\Tool\ImageType;
use MH\MailBundle\Form\Tool\PoliceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ToolController extends Controller
{
    public function indexAction()
    {
        return $this->render('MHMailBundle:Tool:index.html.twig');
    }

    public function addCouleurAction (Request $request)
    {
        $couleur = new Couleur(0,"","");
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

    public function addPoliceAction (Request $request)
    {
        $police = new Police(1,0);
        $police->setTaille(14);

        $form = $this
            ->get('form.factory')
            ->create(PoliceType::class,$police);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($police);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Police créé'
                );

            return $this->redirectToRoute('mh_mail_police_view');
        }

        return $this->render('MHMailBundle:Tool\Police:add.html.twig', array(
            'form'=>$form->createView(),
        ));
    }

    public function viewPoliceAction ()
    {
        $listPolice = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Tool\Police')
            ->findAll();
        return $this->render('MHMailBundle:Tool\Police:view.html.twig',array(
            'listPolice'=>$listPolice
        ));
    }

    public function editPoliceAction (Request $request, $id)
    {
        $police = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Tool\Police')
            ->find($id);

        $form = $this
            ->get('form.factory')
            ->create(PoliceType::class,$police);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($police);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Police modifié'
                );

            return $this->redirectToRoute('mh_mail_police_view');
        }

        return $this->render('MHMailBundle:Tool\Police:edit.html.twig', array(
            'id'=>$police->getId(),
            'form'=>$form->createView()
        ));
    }

    public function deletePoliceAction (Request $request, $id)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $police = $em
            ->getRepository('MHMailBundle:Tool\Police')
            ->find($id);

        if (null === $police) {
            throw new NotFoundHttpException("La Police ".$id." n'existe pas");
        }

        $form = $this
            ->get('form.factory')
            ->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->remove($police);
            $em->flush();

            $this->addFlash(
                'notice',
                'Police supprimée'
            );

            return $this->redirectToRoute('mh_mail_police_view');
        }

        return $this
            ->render('MHMailBundle:Tool\Police:delete.html.twig',array(
                'id'=>$police->getId(),
                'form'=>$form->createView()
            ));
    }

    public function addImageAction (Request $request)
    {
        $image = new Image();
        $image->setSrc("");

        $form = $this
            ->get('form.factory')
            ->create(ImageType::class,$image);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($image);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Image créé'
                );

            return $this->redirectToRoute('mh_mail_image_view');
        }

        return $this->render('MHMailBundle:Tool\Image:add.html.twig', array(
            'form'=>$form->createView(),
        ));
    }

    public function viewImageAction ()
    {
        $listImage = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Tool\Image')
            ->findAll();
        return $this->render('MHMailBundle:Tool\Image:view.html.twig',array(
            'listImage'=>$listImage
        ));
    }

    public function editImageAction (Request $request, $id)
    {
        $image = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:Tool\Image')
            ->find($id);

        $form = $this
            ->get('form.factory')
            ->create(ImageType::class,$image);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($image);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Image modifié'
                );

            return $this->redirectToRoute('mh_mail_image_view');
        }

        return $this->render('MHMailBundle:Tool\Image:edit.html.twig', array(
            'id'=>$image->getId(),
            'form'=>$form->createView()
        ));
    }

    public function deleteImageAction (Request $request, $id)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $image = $em
            ->getRepository('MHMailBundle:Tool\Image')
            ->find($id);

        if (null === $image) {
            throw new NotFoundHttpException("La Image ".$id." n'existe pas");
        }

        $form = $this
            ->get('form.factory')
            ->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->remove($image);
            $em->flush();

            $this->addFlash(
                'notice',
                'Image supprimée'
            );

            return $this->redirectToRoute('mh_mail_image_view');
        }

        return $this
            ->render('MHMailBundle:Tool\Image:delete.html.twig',array(
                'id'=>$image->getId(),
                'form'=>$form->createView()
            ));
    }

    public function addTypeAction (Request $request)
    {
        $type = new PostType();

        $form = $this
            ->get('form.factory')
            ->create(PostTypeType::class,$type);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $type->setPosition(0);

            $em->persist($type);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Type créé'
                );

            return $this->redirectToRoute('mh_mail_type_view');
        }

        return $this->render('MHMailBundle:Tool\Type:add.html.twig', array(
            'form'=>$form->createView(),
        ));
    }

    public function viewTypeAction ()
    {
        $listType = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:PostType')
            ->findAll();
        return $this->render('MHMailBundle:Tool\Type:view.html.twig',array(
            'listType'=>$listType
        ));
    }

    public function editTypeAction (Request $request, $id)
    {
        $type = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:PostType')
            ->find($id);

        $form = $this
            ->get('form.factory')
            ->create(PostTypeType::class,$type);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($type);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Type modifié'
                );

            return $this->redirectToRoute('mh_mail_type_view');
        }

        return $this->render('MHMailBundle:PostType:edit.html.twig', array(
            'id'=>$type->getId(),
            'form'=>$form->createView()
        ));
    }

    public function deleteTypeAction (Request $request, $id)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $type = $em
            ->getRepository('MHMailBundle:PostType')
            ->find($id);

        if (null === $type) {
            throw new NotFoundHttpException("La Type ".$id." n'existe pas");
        }

        $form = $this
            ->get('form.factory')
            ->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->remove($type);
            $em->flush();

            $this->addFlash(
                'notice',
                'Type supprimée'
            );

            return $this->redirectToRoute('mh_mail_type_view');
        }

        return $this
            ->render('MHMailBundle:Tool\Type:delete.html.twig',array(
                'id'=>$type->getId(),
                'form'=>$form->createView()
            ));
    }



}
