<?php

namespace Starter\BillingBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Starter\BillingBundle\Entity\InvoiceStatus;
use Starter\BillingBundle\Form\InvoiceStatusType;

/**
 * InvoiceStatus controller.
 *
 * @Route("/invoicestatus")
 */
class InvoiceStatusController extends Controller
{

    /**
     * Lists all InvoiceStatus entities.
     *
     * @Route("/", name="starter_billing_invoice_status")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('StarterBillingBundle:InvoiceStatus')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new InvoiceStatus entity.
     *
     * @Route("/", name="starter_billing_invoice_status_create")
     * @Method("POST")
     * @Template("StarterBillingBundle:InvoiceStatus:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new InvoiceStatus();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('starter_billing_invoice_status_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a InvoiceStatus entity.
     *
     * @param InvoiceStatus $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(InvoiceStatus $entity)
    {
        $form = $this->createForm(new InvoiceStatusType(), $entity, array(
            'action' => $this->generateUrl('starter_billing_invoice_status_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new InvoiceStatus entity.
     *
     * @Route("/new", name="starter_billing_invoice_status_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new InvoiceStatus();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a InvoiceStatus entity.
     *
     * @Route("/{id}", name="starter_billing_invoice_status_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StarterBillingBundle:InvoiceStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InvoiceStatus entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing InvoiceStatus entity.
     *
     * @Route("/{id}/edit", name="starter_billing_invoice_status_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StarterBillingBundle:InvoiceStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InvoiceStatus entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a InvoiceStatus entity.
    *
    * @param InvoiceStatus $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(InvoiceStatus $entity)
    {
        $form = $this->createForm(new InvoiceStatusType(), $entity, array(
            'action' => $this->generateUrl('starter_billing_invoice_status_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing InvoiceStatus entity.
     *
     * @Route("/{id}", name="starter_billing_invoice_status_update")
     * @Method("PUT")
     * @Template("StarterBillingBundle:InvoiceStatus:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StarterBillingBundle:InvoiceStatus')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find InvoiceStatus entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('starter_billing_invoice_status_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a InvoiceStatus entity.
     *
     * @Route("/{id}", name="starter_billing_invoice_status_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('StarterBillingBundle:InvoiceStatus')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find InvoiceStatus entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('starter_billing_invoice_status'));
    }

    /**
     * Creates a form to delete a InvoiceStatus entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('starter_billing_invoice_status_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
