<?php

namespace Time\TrackerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Time\TrackerBundle\Entity\Regex;
use Time\TrackerBundle\Form\RegexType;

/**
 * Regex controller.
 *
 * @Route("/regex")
 */
class RegexController extends Controller
{

    /**
     * Lists all Regex entities.
     *
     * @Route("/", name="regex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TimeTrackerBundle:Regex')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Regex entity.
     *
     * @Route("/", name="regex_create")
     * @Method("POST")
     * @Template("TimeTrackerBundle:Regex:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Regex();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('regex_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Regex entity.
     *
     * @param Regex $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Regex $entity)
    {
        $form = $this->createForm(new RegexType(), $entity, array(
            'action' => $this->generateUrl('regex_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Regex entity.
     *
     * @Route("/new", name="regex_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Regex();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Regex entity.
     *
     * @Route("/{id}", name="regex_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TimeTrackerBundle:Regex')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Regex entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Regex entity.
     *
     * @Route("/{id}/edit", name="regex_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TimeTrackerBundle:Regex')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Regex entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Regex entity.
     *
     * @param Regex $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Regex $entity)
    {
        $form = $this->createForm(new RegexType(), $entity, array(
            'action' => $this->generateUrl('regex_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Regex entity.
     *
     * @Route("/{id}", name="regex_update")
     * @Method("PUT")
     * @Template("TimeTrackerBundle:Regex:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TimeTrackerBundle:Regex')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Regex entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('regex_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Regex entity.
     *
     * @Route("/{id}", name="regex_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TimeTrackerBundle:Regex')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Regex entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('regex'));
    }

    /**
     * Creates a form to delete a Regex entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('regex_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
