<?php

namespace Starter\PlanBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Starter\PlanBundle\Entity\Price;
use Starter\PlanBundle\Form\PriceType;

/**
 * Price controller.
 *
 * @Route("/price")
 */
class PriceController extends Controller
{
    /**
     * Lists all Price entities.
     *
     * @Route("/", name="starter_plan_price")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('StarterPlanBundle:Price')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Price entity.
     *
     * @Route("/", name="starter_plan_price_create")
     * @Method("POST")
     * @Template("StarterPlanBundle:Price:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Price();
        $form = $this->createForm(new PriceType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if($entity->getIsDefault()) {
                $dql = 'UPDATE StarterPlanBundle:Price p SET p.isDefault = 0 WHERE p.isDefault = 1';
                $updateQuery = $em->createQuery($dql);
                $updateQuery->execute();
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('starter_plan_price'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Price entity.
     *
     * @Route("/new", name="starter_plan_price_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Price();
        $form   = $this->createForm(new PriceType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Price entity.
     *
     * @Route("/{id}/edit", name="starter_plan_price_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StarterPlanBundle:Price')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Price entity.');
        }

        $editForm = $this->createForm(new PriceType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Price entity.
     *
     * @Route("/{id}", name="starter_plan_price_update")
     * @Method("PUT")
     * @Template("StarterPlanBundle:Price:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('StarterPlanBundle:Price')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Price entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PriceType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            if($entity->getIsDefault()) {
                $dql = 'UPDATE StarterPlanBundle:Price p SET p.isDefault = 0 WHERE p.isDefault = 1';
                $updateQuery = $em->createQuery($dql);
                $updateQuery->execute();
            }
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('starter_plan_price_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Price entity.
     *
     * @Route("/{id}", name="starter_plan_price_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('StarterPlanBundle:Price')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Price entity.');
            }

            $em->remove($entity);
            $em->flush();
        } else {
            var_dump($form->getErrors()); die;
        }

        return $this->redirect($this->generateUrl('starter_plan_price'));
    }

    /**
     * Creates a form to delete a Price entity by id.
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
