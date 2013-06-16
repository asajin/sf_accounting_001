<?php

namespace Common\DataBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Common\DataBundle\Entity\Unit;
use Common\DataBundle\Form\UnitType;

/**
 * Unit controller.
 *
 * @Route("/unit")
 */
class UnitController extends Controller
{
    /**
     * Lists all Unit entities.
     *
     * @Route("/", name="unit")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CommonDataBundle:Unit')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Unit entity.
     *
     * @Route("/{id}/show", name="unit_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CommonDataBundle:Unit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Unit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Unit entity.
     *
     * @Route("/new", name="unit_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Unit();
        $form   = $this->createForm(new UnitType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Unit entity.
     *
     * @Route("/create", name="unit_create")
     * @Method("POST")
     * @Template("CommonDataBundle:Unit:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Unit();
        $form = $this->createForm(new UnitType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('unit_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Unit entity.
     *
     * @Route("/{id}/edit", name="unit_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CommonDataBundle:Unit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Unit entity.');
        }

        $editForm = $this->createForm(new UnitType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Unit entity.
     *
     * @Route("/{id}/update", name="unit_update")
     * @Method("POST")
     * @Template("CommonDataBundle:Unit:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CommonDataBundle:Unit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Unit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new UnitType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('unit_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Unit entity.
     *
     * @Route("/{id}/delete", name="unit_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CommonDataBundle:Unit')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Unit entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('unit'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
