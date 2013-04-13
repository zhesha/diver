<?php

namespace Diver\PriceLisrBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Diver\PriceLisrBundle\Entity\Items;
use Diver\PriceLisrBundle\Form\ItemsType;

/**
 * Items controller.
 *
 */
class ItemsController extends Controller
{
    /**
     * Lists all Items entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DiverPriceLisrBundle:Items')->findAll();

        return $this->render('DiverPriceLisrBundle:Items:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Items entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Items();
        $form = $this->createForm(new ItemsType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('items_show', array('id' => $entity->getId())));
        }

        return $this->render('DiverPriceLisrBundle:Items:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Items entity.
     *
     */
    public function newAction()
    {
        $entity = new Items();
        $form   = $this->createForm(new ItemsType(), $entity);

        return $this->render('DiverPriceLisrBundle:Items:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Items entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DiverPriceLisrBundle:Items')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Items entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DiverPriceLisrBundle:Items:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Items entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DiverPriceLisrBundle:Items')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Items entity.');
        }

        $editForm = $this->createForm(new ItemsType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('DiverPriceLisrBundle:Items:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Items entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DiverPriceLisrBundle:Items')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Items entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ItemsType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('items_edit', array('id' => $id)));
        }

        return $this->render('DiverPriceLisrBundle:Items:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Items entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DiverPriceLisrBundle:Items')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Items entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('items'));
    }

    /**
     * Creates a form to delete a Items entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
