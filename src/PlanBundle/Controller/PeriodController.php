<?php

namespace Starter\PlanBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Starter\PlanBundle\Entity\Period;
use Starter\PlanBundle\Form\PeriodType;

/**
 * Period controller.
 *
 * @Route("/plan/period")
 */
class PeriodController extends Controller
{
    /**
     * Lists all Period entities.
     *
     * @Route("/", name="admin_plan_period")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('StarterPlanBundle:Period')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Period entity.
     *
     * @Route("/", name="admin_plan_period_create")
     * @Method("POST")
     * @Template("StarterPlanBundle:Period:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Period();
        $form = $this->createForm(new PeriodType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_plan_period'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Period entity.
     *
     * @Route("/new", name="admin_plan_period_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Period();
        $form   = $this->createForm(new PeriodType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Period entity.
     *
     * @Route("/{id}/edit", name="admin_plan_period_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StarterPlanBundle:Period')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Period entity.');
        }

        $editForm = $this->createForm(new PeriodType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Period entity.
     *
     * @Route("/{id}", name="admin_plan_period_update")
     * @Method("PUT")
     * @Template("StarterPlanBundle:Period:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StarterPlanBundle:Period')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Period entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PeriodType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_plan_period_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Period entity.
     *
     * @Route("/{id}", name="admin_plan_period_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('StarterPlanBundle:Period')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Period entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_plan_period'));
    }

    /**
     * Creates a form to delete a Period entity by id.
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
