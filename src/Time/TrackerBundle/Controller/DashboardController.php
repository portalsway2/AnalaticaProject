<?php
/**
 * Created by PhpStorm.
 * User: portalsway3
 * Date: 4/3/14
 * Time: 6:21 PM
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
 * Class DashboardController
 * @package Time\TrackerBundle\Controller
 */
class DashboardController extends Controller
{

    /**
     * @Route("/dashboard", name="dashboard")
     * @Method("GET")
     * @Template("TimeTrackerBundle:Dashboard:dashboard.html.twig")
     */
    public function dashboardAction()
    {

    }


} 