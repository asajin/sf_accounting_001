<?php

namespace Common\DataBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Common\DataBundle\Entity\Supplier;
use Common\DataBundle\Form\SupplierType;

/**
 * Supplier controller.
 *
 * @Route("/supplier")
 */
class SupplierController extends Controller
{
    /**
     * Lists all Supplier entities.
     *
     * @Route("/", name="supplier")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CommonDataBundle:Supplier')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Supplier entity.
     *
     * @Route("/{id}/show", name="supplier_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CommonDataBundle:Supplier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Supplier entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Supplier entity.
     *
     * @Route("/new", name="supplier_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Supplier();
        $form   = $this->createForm(new SupplierType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Supplier entity.
     *
     * @Route("/create", name="supplier_create")
     * @Method("POST")
     * @Template("CommonDataBundle:Supplier:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Supplier();
        $form = $this->createForm(new SupplierType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('supplier_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Supplier entity.
     *
     * @Route("/{id}/edit", name="supplier_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CommonDataBundle:Supplier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Supplier entity.');
        }

        $editForm = $this->createForm(new SupplierType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Supplier entity.
     *
     * @Route("/{id}/update", name="supplier_update")
     * @Method("POST")
     * @Template("CommonDataBundle:Supplier:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CommonDataBundle:Supplier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Supplier entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new SupplierType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('supplier_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Supplier entity.
     *
     * @Route("/{id}/delete", name="supplier_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CommonDataBundle:Supplier')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Supplier entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('supplier'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
