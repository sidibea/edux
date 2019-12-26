<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15/11/2019
 * Time: 22:27
 */

namespace ES\MainBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('ESMainBundle::index.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('ESMainBundle::about.html.twig');
    }

    public function contactAction()
    {
        return $this->render('ESMainBundle::contact.html.twig');
    }

}