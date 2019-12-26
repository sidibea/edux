<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26/12/2019
 * Time: 19:38
 */

namespace ES\MainBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AjaxController extends Controller
{

    public function siteInfoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->isXmlHttpRequest())
        {
            $info = $em->getRepository('ESAdminBundle:Reglage')->find(1);

            return new JsonResponse([
                'data' => $info
            ]);
        }

        return new JsonResponse("Erreur: Ce n'est pas une requête Ajax ");

    }

}