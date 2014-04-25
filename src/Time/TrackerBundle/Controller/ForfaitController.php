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


}