<?php

namespace ES\ParentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ESParentBundle:Default:index.html.twig');
    }
}
