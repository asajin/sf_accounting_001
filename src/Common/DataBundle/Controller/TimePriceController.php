<?php

namespace Common\DataBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Common\DataBundle\Entity\TimePrice;
use Common\DataBundle\Form\TimePriceType;

/**
 * TimePrice controller.
 *
 * @Route("/timeprice")
 */
class TimePriceController extends Controller
{
    /**
     * Lists all TimePrice entities.
     *
     * @Route("/", name="timeprice")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CommonDataBundle:TimePrice')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a TimePrice entity.
     *
     * @Route("/{id}/show", name="timeprice_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CommonDataBundle:TimePrice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TimePrice entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new TimePrice entity.
     *
     * @Route("/new", name="timeprice_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TimePrice();
        $form   = $this->createForm(new TimePriceType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new TimePrice entity.
     *
     * @Route("/create", name="timeprice_create")
     * @Method("POST")
     * @Template("CommonDataBundle:TimePrice:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new TimePrice();
        $form = $this->createForm(new TimePriceType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('timeprice_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TimePrice entity.
     *
     * @Route("/{id}/edit", name="timeprice_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CommonDataBundle:TimePrice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TimePrice entity.');
        }

        $editForm = $this->createForm(new TimePriceType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing TimePrice entity.
     *
     * @Route("/{id}/update", name="timeprice_update")
     * @Method("POST")
     * @Template("CommonDataBundle:TimePrice:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CommonDataBundle:TimePrice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TimePrice entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TimePriceType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('timeprice_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a TimePrice entity.
     *
     * @Route("/{id}/delete", name="timeprice_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CommonDataBundle:TimePrice')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TimePrice entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('timeprice'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
