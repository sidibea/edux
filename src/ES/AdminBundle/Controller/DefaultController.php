<?php

namespace ES\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ESAdminBundle:Default:index.html.twig');
    }
}
