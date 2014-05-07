<?php
/**
 * Created by PhpStorm.
 * User: portalsway3
 * Date: 3/20/14
 * Time: 4:13 PM
 */

namespace Time\TrackerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Time\TrackerBundle\Entity\User;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Time\TrackerBundle\Form\UserType;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;


use Time\TrackerBundle\Entity\Session;

/**
 * Class AfficheController
 * @package Time\TrackerBundle\Controller
 */
class AfficheController extends Controller
{


    public function postAfficheAction(Request $request)
    {


        $urlparam = $request->server->getHeaders();
        $token = $urlparam["TOKEN"];
        $navigateur = $this->FindNavigateur();
        $systeme = $this->FindOS();
        $user = $this->FindToken($token);

        if ($user) {
            return (array(

                "navigateur" => $navigateur,
                "systeme" => $systeme,

            ));

        } else {
            return (array(

                "navigateur" => null,
                "systeme" => null,

            ));
        }

    }

    /**
     * @param $token
     * @return mixed
     */
    private function FindToken($token)
    {


        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('TimeTrackerBundle:User')->findBy(array('token' => $token));

        return $user[0];


    }


    /**
     * @Route("os", name="os")
     * @Method("GET")
     * @Template("TimeTrackerBundle:Agent:os.html.twig")
     */

    public function osAction()
    {

        $user = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TimeTrackerBundle:ListOS')->findBy(array("idUser" => $user));
        $listOs = array();
        foreach ($entities as $os) {

            $osArray[0] = $os->getName();
            $osArray[1] = $os->getCount();

            array_push($listOs, $osArray);

        }

        return array(
            'entities' => $entities,
            'listOs' => $listOs,
        );
    }


    /**
     * @Route("navigateur", name="navigateur")
     * @Method("GET")
     * @Template("TimeTrackerBundle:Agent:navigateur.html.twig")
     */
    public function navigateurAction()
    {

        $user = $this->container->get('security.context')->getToken()->getUser();


        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TimeTrackerBundle:ListNavigateur')->findBy(array("idUser" => $user));
        $listNavigateur = array();
        foreach ($entities as $navigateur) {

            $navigateurArray[0] = $navigateur->getName();
            $navigateurArray[1] = $navigateur->getCount();
            array_push($listNavigateur, $navigateurArray);

        }

        return array(
            'entities' => $entities,
            'listNavigateur' => $listNavigateur,
        );
    }


    /**
     * @Route("device", name="device")
     * @Method("GET")
     * @Template("TimeTrackerBundle:Agent:device.html.twig")
     */

    public function deviceAction()
    {

        $user = $this->container->get('security.context')->getToken()->getUser();


        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TimeTrackerBundle:ListDevice')->findBy(array("idUser" => $user));
        $listDevice = array();
        foreach ($entities as $device) {

            $deviceArray[0] = $device->getName();
            $deviceArray[1] = $device->getCount();

            array_push($listDevice, $deviceArray);

        }

        return array(
            'entities' => $entities,
            'listDevice' => $listDevice,
        );
    }


    /**
     * @Route("ip", name="ip")
     * @Method("GET")
     * @Template("TimeTrackerBundle:Agent:ip.html.twig")
     */
    public function IPAction()
    {

        $user = $this->container->get('security.context')->getToken()->getUser();


        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TimeTrackerBundle:UserAgent')->findBy(array("idUser" => $user));

        $listip = array();
        foreach ($entities as $ip) {

            return array(
                'entities' => $entities,
                'listip' => $listip,
            );
        }

    }

    /**
     * @Route("statistique", name="statistique")
     * @Method("GET")
     * @Template("TimeTrackerBundle:Agent:statistique.html.twig")
     */
    public function statistiqueAction()
    {
    }

    /**
     * @Route("useragent", name="useragent")
     * @Method("GET")
     * @Template("TimeTrackerBundle:Agent:useragent.html.twig")
     */
    public function useragentAction()
    {
    }


    /**
     * @Route("statistique", name="statistique")
     * @Method("GET")
     * @Template("TimeTrackerBundle:Agent:statistique.html.twig")
     */
    public function statosAction()
    {

        $user = $this->container->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TimeTrackerBundle:ListOS')->findBy(array("idUser" => $user));
        $listStat = array();
        foreach ($entities as $stat) {
            $statArray[0] = $stat->getCount();
            array_push($listStat, $statArray);

        }


    }

}


