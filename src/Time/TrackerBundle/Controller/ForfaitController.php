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
use Time\TrackerBundle\Entity\ForfaitUser;
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
        $forfaituser = $em->getRepository('TimeTrackerBundle:ForfaitUser')->findBy(array('iduser' => $user));

        if (!$forfaituser) {
            $forfaituser1 = new ForfaitUser();
            $forfaituser1->setNbrRequest($forfait->getNbruseragent());
            $forfaituser1->setIduser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($forfaituser1);
            $em->flush();
            return $this->redirect($this->generateUrl('choiceforfait', array('id' => $forfait->getId())));
        } else {
            $forfaituser[0]->setNbrRequest($forfaituser[0]->getNbrRequest() + $forfait->getNbruseragent());
            $em->flush();

            return $this->redirect($this->generateUrl('choiceforfait', array('id' => $forfait->getId())));

        }

    }


    /**
     * @Route("choiceforfait/{id}", name="choiceforfait")
     * @Method("GET")
     * @Template("TimeTrackerBundle:Agent:choice_forfait.html.twig")
     */
    public function choiceforfaitAction($id)
    {


        $forfait = $this->getDoctrine()
            ->getRepository('TimeTrackerBundle:Forfait')
            ->find($id);


        return array('forfait' => $forfait);

    }

}