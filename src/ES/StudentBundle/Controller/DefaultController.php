<?php

namespace ES\StudentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ESStudentBundle:Default:index.html.twig');
    }
}
