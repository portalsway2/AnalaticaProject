<?php
/**
 * Created by PhpStorm.
 * User: portalsway3
 * Date: 4/5/14
 * Time: 3:41 PM
 */

namespace Time\TrackerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Time\TrackerBundle\Entity\User;
use Time\TrackerBundle\Form\UserType;


/**
 * Class ForfaitContoller
 * @package Time\TrackerBundle\Controller
 */
class ForfaitController extends Controller
{

    /**
     * @Route("forfait", name="forfait")
     * @Method("GET")
     * @Template("TimeTrackerBundle:Agent:forfait.html.twig")
     */
    public function ForfaitAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TimeTrackerBundle:Forfait')->findALL();

        return array('entities' => $entities);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function Save_forfaitAction($id)
    {

        $user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $forfait = $em->getRepository('TimeTrackerBundle:Forfait')->find($id);

        if (($user->getIdforfait()) == NULL) {
            $user->setIdforfait($forfait);
            $em->flush();
            return $this->redirect($this->generateUrl('choiceforfait'));
        } else {
            return $this->redirect($this->generateUrl('choiceforfait'));

        }

    }


    /**
     * @Route("choiceforfait", name="choiceforfait")
     * @Method("GET")
     * @Template("TimeTrackerBundle:Agent:choice_forfait.html.twig")
     */
    public function choiceforfaitAction()
    {

        $user = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()
            ->getRepository('TimeTrackerBundle:User')
            ->find($user);

        $forfait = $user->getIdforfait();
        if ($forfait)

            return array('forfait' => $forfait);

    }

}