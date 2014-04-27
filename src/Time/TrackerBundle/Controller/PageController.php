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
use Time\TrackerBundle\Form\UserType;

/**
 * Class PageController
 * @package Time\TrackerBundle\Controller
 */
class PageController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Method("GET")
     * @Template("TimeTrackerBundle:FirstPage:home.html.twig")
     */
    public function homeAction()
    {

        $user = $this->container->get('security.context')->isGranted('ROLE_USER');
        if ($this->container->get('security.context')->isGranted('ROLE_USER')) {

            return $this->render('TimeTrackerBundle:Dashboard:dashboard.html.twig');


        } else {
            return $this->render('TimeTrackerBundle:FirstPage:home.html.twig');


        }
    }

}