<?php

namespace MH\MailBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PostTypeController extends Controller
{

    public function selectAction(Request $request, $id)
    {
        if (!$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Only ajax accepted');
        }

        $listPostType = $this
            ->getDoctrine()
            ->getRepository('MHMailBundle:PostType')
            ->findAll();

        //$mail_id = $post->getMail()->getId();

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
