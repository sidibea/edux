<?php

namespace ES\AdminBundle\Controller;

use ES\AdminBundle\Entity\Category;
use ES\AdminBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Cocur\Slugify\Slugify;

/**
 * Category controller.
 *
 */
class CategoryController extends Controller
{
    /**
     * Lists all category entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('ESAdminBundle:Category')->findAll();

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        if($form->handleRequest($request)->isValid())
        {
            if($category->getSlug() == null)
            {
                $slugify = new Slugify();
                $category->setSlug($slugify->slugify($form->get('nomFr')->getData()));
            }
            $category->setUpdatedAt(new \datetime);
            $category->setCreatedAt(new \datetime);
            $em->persist($category);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'La catégorie a été enregistré.');
            return $this->redirectToRoute('category_index');
        }

        return $this->render('ESAdminBundle:category:index.html.twig', array(
            'categories' => $categories,
            'form' => $form->createView()
        ));
    }





    /**
     * Displays a form to edit an existing category entity.
     *
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('ESAdminBundle:Category')->find($id);
        $categories = $em->getRepository('ESAdminBundle:Category')->findAll();


        $form = $this->createForm(CategoryType::class, $category);

        if ($form->handleRequest($request)->isValid()) {

            $category->setUpdatedAt(new \datetime);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'La catégorie a été enregistré.');
            return $this->redirectToRoute('category_index');
        }

        return $this->render('ESAdminBundle:category:edit.html.twig', array(
            'category' => $category,
            'categories' => $categories,
            'form' => $form->createView(),
        ));
    }

    /**
     * Deletes a category entity.
     *
     */
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('ESAdminBundle:Category')->find($id);

        try{
            $em->remove($category);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'La catégorie a été supprimé.');
            return $this->redirectToRoute('category_index');
        }catch(\Exception $e){
            $request->getSession()->getFlashBag()->add('warning', 'Impossible de supprimer cette catégories. Des articles sont liés à cette categories');
            return $this->redirectToRoute('category_index');
        }
    }

    /**
     * Creates a form to delete a category entity.
     *
     * @param Category $category The category entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Category $category)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('category_delete', array('id' => $category->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
