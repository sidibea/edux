<?php

namespace ES\AdminBundle\Controller;

use ES\AdminBundle\Entity\Reglage;
use ES\AdminBundle\Form\ReglageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Reglage controller.
 *
 */
class ReglageController extends Controller
{

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $reglages = $em->getRepository('ESAdminBundle:Reglage')->find(1);

        if($reglages == null)
        {
            $reglages = new Reglage();
            $form = $this->createForm(ReglageType::class, $reglages);

            if($form->handleRequest($request)->isValid())
            {
                $reglages->setCreatedAt(new \datetime);
                $reglages->setUpdatedAt(new \datetime);

                $em->persist($reglages);
                $em->flush();

                $request->getSession()->getFlashBag()->add('success', 'Le reglage a été enregistré.');
                return $this->redirectToRoute('reglage_index');
            }
        }else{
            $reglages = $em->getRepository('ESAdminBundle:Reglage')->find(1);
            $form = $this->createForm(ReglageType::class, $reglages);

            if($form->handleRequest($request)->isValid())
            {
                $reglages->setCreatedAt(new \datetime);
                $reglages->setUpdatedAt(new \datetime);

                $em->persist($reglages);
                $em->flush();

                $request->getSession()->getFlashBag()->add('success', 'Le reglage a été enregistré.');
                return $this->redirectToRoute('reglage_index');
            }
        }

        //dump($reglages); exit;

        return $this->render('ESAdminBundle:reglage:index.html.twig', array(
            'reglages' => $reglages,
            'form' => $form->createView()
        ));
    }


}
