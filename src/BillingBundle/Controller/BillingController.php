<?php

namespace Starter\BillingBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Starter\BillingBundle\Entity\Billing;
use Starter\BillingBundle\Form\BillingType;

/**
 * Billing controller.
 *
 * @Route("/admin/billing")
 */
class BillingController extends Controller
{
    /**
     * Lists all Billing entities.
     *
     * @Route("/", name="admin_billing")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('StarterBillingBundle:Billing')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Billing entity.
     *
     * @Route("/", name="admin_billing_create")
     * @Method("POST")
     * @Template("StarterBillingBundle:Billing:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Billing();
        $form = $this->createForm(new BillingType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em             = $this->getDoctrine()->getManager();
            $plan           = $entity->getPlan();
            $period         = $entity->getPeriod();
            $entity->setCreatedAt(new \DateTime());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_billing'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Billing entity.
     *
     * @Route("/new", name="admin_billing_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Billing();
        $form   = $this->createForm(new BillingType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Billing entity.
     *
     * @Route("/{id}", name="admin_billing_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StarterBillingBundle:Billing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Billing entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Billing entity.
     *
     * @Route("/{id}/edit", name="admin_billing_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StarterBillingBundle:Billing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Billing entity.');
        }

        $editForm   = $this->createForm(new BillingType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Billing entity.
     *
     * @Route("/{id}", name="admin_billing_update")
     * @Method("PUT")
     * @Template("StarterBillingBundle:Billing:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StarterBillingBundle:Billing')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Billing entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new BillingType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $plan           = $entity->getPlan();
            $period         = $entity->getPeriod();

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_billing'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Billing entity.
     *
     * @Route("/{id}", name="admin_billing_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('StarterBillingBundle:Billing')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Billing entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_billing'));
    }

    /**
     * Creates a form to delete a Billing entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
}
