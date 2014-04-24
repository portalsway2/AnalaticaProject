<?php
/**
 * Created by PhpStorm.
 * User: portalsway3
 * Date: 4/2/14
 * Time: 7:14 PM
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
 * Class ErreurController
 * @package Time\TrackerBundle\Controller
 */
class ErreurController extends Controller

{
    /**
     * @Route("/erreur", name="erreur")
     * @Method("GET")
     * @Template("TimeTrackerBundle:Erreur:erreur.html.twig")
     */
    public function homeAction()
    {

    }

}