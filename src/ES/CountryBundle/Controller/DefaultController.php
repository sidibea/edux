<?php

namespace ES\CountryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ESCountryBundle:Default:index.html.twig');
    }
}
