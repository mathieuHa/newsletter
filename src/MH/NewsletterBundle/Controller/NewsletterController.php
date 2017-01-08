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

class NewsletterController extends Controller
{
    public function indexAction()
    {
        $listNewsletter= $this
            ->getDoctrine()
            ->getRepository('MHNewsletterBundle:Newsletter')
            ->findAll();

        return $this->render('MHNewsletterBundle:Newsletter:index.html.twig', array(
            'listNewsletter'=>$listNewsletter
        ));
    }

    public function createAction (Request $request)
    {
        $newsletter = new Newsletter();
        $newsletter
            ->setName("une newsletter")
            ->setWeek("Semaine 1");

        $rubrique = new Rubrique();
        $rubrique->
            setPosition(0)
            ->setIcone("http://esiea.fr/e-bdo/icone-actu.png")
            ->setImage("https://www.esiea.fr/wp-content/uploads/2016/09/actu-2.png")
            ->setName("Quoi de neuf");
        $post = new Post();
        $post
            ->setTitre("Un post")
            ->setContent("du Texte")
            ->setPosition(0);
        $rubrique
            ->addPost($post);
        $newsletter->addRubrique($rubrique);


        $rubrique = new Rubrique();
        $rubrique->
        setPosition(1)
            ->setIcone("http://esiea.fr/e-bdo/icone-presse.png")
            ->setImage("https://www.esiea.fr/wp-content/uploads/2016/09/presse-2.png")
            ->setName("Les écoles dans la presse");
        $newsletter->addRubrique($rubrique);

        $form = $this
            ->get('form.factory')
            ->create(NewsletterType::class,$newsletter);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();

            $em->persist($newsletter);
            $em->flush();

            $this
               ->addFlash(
                  'notice','Newsletter crée'
              );

            return $this->redirectToRoute('mh_newsletter_edit',array(
                'id'=>$newsletter->getId()
            ));
        }



        return $this->render('MHNewsletterBundle:Newsletter:create.html.twig', array(
            'form'=>$form->createView(),
            '$newsletter'=>$newsletter,
        ));
    }

    public function viewAction ($id)
    {
        $newsletter = $this
            ->getDoctrine()
            ->getRepository('MHNewsletterBundle:Newsletter')
            ->find($id);
        return $this->render('MHNewsletterBundle:Template:newsletter.html.twig',array(
            'newsletter'=>$newsletter
        ));
    }

    public function editAction (Request $request, $id)
    {
        $newsletter = $this
            ->getDoctrine()
            ->getRepository('MHNewsletterBundle:Newsletter')
            ->find($id);
        $form = $this
            ->get('form.factory')
            ->create(NewsletterType::class,$newsletter);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this
                ->getDoctrine()
                ->getManager();


            $em->persist($newsletter);
            $em->flush();

            $this
                ->addFlash(
                    'notice','Newsletter mise à jour'
                );

            return $this->redirectToRoute('mh_newsletter_edit',array(
                'id'=>$newsletter->getId()
            ));
        }

        return $this->render('MHNewsletterBundle:Newsletter:edit.html.twig', array(
            'form'=>$form->createView(),
            'newsletter'=>$newsletter,
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

    public function deleteAction (Request $request, $id)
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $newsletter = $this
            ->getDoctrine()
            ->getRepository('MHNewsletterBundle:Newsletter')
            ->find($id);

        if (null === $newsletter) {
            throw new NotFoundHttpException("La newsletter ".$id." n'existe pas");
        }

        $form = $this
            ->get('form.factory')
            ->create();
        /* la suppression des rubriques n'est pas fonctionnelle*/
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->remove($newsletter);
            $em->flush();

            $this->addFlash(
                'notice',
                'Newsletter supprimée'
            );

            return $this->redirectToRoute('mh_newsletter_home');
        }

        return $this
            ->render('MHNewsletterBundle:Newsletter:delete.html.twig',array(
                'newsletter'=>$newsletter,
                'form'=>$form->createView()
            ));
    }
}
