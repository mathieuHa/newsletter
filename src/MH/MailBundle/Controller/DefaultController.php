<?php

namespace MH\MailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MHMailBundle:Default:index.html.twig');
    }
}
