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
            ->setWeek("Semaine 1")
            ->setPosition(0);

        $rubrique = new Rubrique();
        $rubrique->
            setPosition(0)
            ->setIcone("http://esiea.fr/e-bdo/icone-actu.png")
            ->setImage("https://www.esiea.fr/wp-content/uploads/2017/01/actu-ebdo-1.jpg")
            ->setName("Quoi de neuf");
        $newsletter->addRubrique($rubrique);

        $rubrique = new Rubrique();
        $rubrique->
        setPosition(1)
            ->setIcone("http://esiea.fr/e-bdo/icone-presse.png")
            ->setImage("https://www.esiea.fr/wp-content/uploads/2017/01/actu-ebdo-2.jpg")
            ->setName("Les écoles dans la presse");
        $newsletter->addRubrique($rubrique);

        $rubrique = new Rubrique();
        $rubrique->
        setPosition(2)
            ->setIcone("http://esiea.fr/e-bdo/icone-campus.png")
            ->setImage("https://www.esiea.fr/wp-content/uploads/2017/01/actu-ebdo-3.jpg")
            ->setName("Vie des campus");
        $newsletter->addRubrique($rubrique);

        $rubrique = new Rubrique();
        $rubrique->
        setPosition(3)
            ->setIcone("http://esiea.fr/e-bdo/icone-projet.png")
            ->setImage("https://www.esiea.fr/wp-content/uploads/2017/01/actu-ebdo-4.jpg")
            ->setName("Challenges & projets");
        $newsletter->addRubrique($rubrique);

        $rubrique = new Rubrique();
        $rubrique->
        setPosition(4)
            ->setIcone("http://esiea.fr/e-bdo/icone-calendrier.png")
            ->setImage("https://www.esiea.fr/wp-content/uploads/2017/01/actu-ebdo-5.jpg")
            ->setName("A vos agendas");
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

    public function viewAction (Newsletter $newsletter)
    {
        if (null === $newsletter) {
            throw new NotFoundHttpException("La newsletter n'existe pas");
        }
        return $this->render('MHNewsletterBundle:Template:newsletter.html.twig',array(
            'newsletter'=>$newsletter
        ));
    }

    public function downloadAction (Newsletter $newsletter)
    {
        if (null === $newsletter) {
            throw new NotFoundHttpException("La newsletter n'existe pas");
        }
        $file = $this->renderView('MHNewsletterBundle:Template:newsletter.html.twig',array(
            'newsletter'=>$newsletter
        ));
        $response = new Response($file);
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/plain');

        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'newsletter_'.$newsletter->getName().'_'.$newsletter->getWeek().'_'.$newsletter->getAuteur().'.html'
        );
        $response->headers->set('Content-Disposition', $disposition);
        return $response;
    }

    public function editAction (Newsletter $newsletter)
    {
        return $this->render('MHNewsletterBundle:Newsletter:edit.html.twig', array(
            'newsletter'=>$newsletter,
        ));
    }

    public function copyAction (Newsletter $newsletter)
    {
        if (null === $newsletter) {
            throw new NotFoundHttpException("La newsletter n'existe pas");
        }
        $new = clone $newsletter;
        $new->setName($newsletter->getName().' copie');
        $new->setDate(new \DateTime());
        $new->setUpdateAt($new->getDate());

        $em = $this->getDoctrine()->getManager();
        $em->persist($new);
        $em->flush();

        $this
            ->addFlash(
                'notice','Newsletter copiée'
            );

        return $this->redirectToRoute('mh_newsletter_home');
    }

    public function editHeaderAction (Request $request, Newsletter $newsletter)
    {
        if (null === $newsletter) {
            throw new NotFoundHttpException("La newsletter n'existe pas");
        }
        $form = $this
            ->get('form.factory')
            ->create(NewsletterType::class,$newsletter);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $newsletter->updateDate();
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

        return $this->render('MHNewsletterBundle:Newsletter:edit-header.html.twig', array(
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

        $normalizer->setCircularReferenceHandler(function (Newsletter $newsletter) {
            return $newsletter->getName();
        });

        $serializer = new Serializer(array($normalizer), array($encoder));
        $json = $serializer->serialize($newsletter, 'json');
        return new Response($json);
    }

    public function deleteAction (Request $request, Newsletter $newsletter)
    {
        if (null === $newsletter) {
            throw new NotFoundHttpException("La newsletter n'existe pas");
        }
        $em = $this
            ->getDoctrine()
            ->getManager();
        $form = $this
            ->get('form.factory')
            ->create();
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

    public function mailAction (Request $request, Newsletter $newsletter)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
        if (null === $newsletter) {
            throw new NotFoundHttpException("La newsletter n'existe pas");
        }
        $user = $this->getUser();
        $form = $this
            ->get('form.factory')
            ->createNamed('mh_newsletterbundle_mail', UserType::class,$user, array(
                'action' => $this->generateUrl('mh_newsletter_mail', array('id' => $newsletter->getId()))));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $message = \Swift_Message::newInstance()
                ->setSubject($newsletter->getName() . ' ' . $newsletter->getWeek())
                ->setFrom('newsletter@hanotaux.fr')
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView(
                        'MHNewsletterBundle:Template:newsletter.html.twig',
                        array('newsletter' => $newsletter)
                    ),
                    'text/html'
                )

            ;
            $this->get('mailer')->send($message);
            $this
                ->addFlash(
                    'notice','Email Envoyé'
                );
            return new JsonResponse(array(
                'status' => 'ok',
                'op' => 'mail envoyé',
                'id'=>$newsletter->getId()
            ));
        }
        return $this->render('MHNewsletterBundle:Newsletter:mail.html.twig', array(
            'form'=>$form->createView(),
            'newsletter'=>$newsletter,
            'user' => $user
        ));
    }

    public function orderAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }
        if ($request->isMethod('POST') && $request->request->has('newsletters') && is_array($newsletters = $request->request->get('newsletters'))) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('MHNewsletterBundle:Newsletter');
            foreach ((array)$newsletters as $i => $newsletter_id) {
                $newsletter = $repository->find($newsletter_id);
                $newsletter->setPosition($i);
            }
            $em->flush();
            return new JsonResponse(array(
                'status' => 'ok',
            ));
        } else {
            throw new BadRequestHttpException('No Newsletter in request');
        }
    }
}
