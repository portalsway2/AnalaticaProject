<?php
/**
 * Created by PhpStorm.
 * User: portalsway3
 * Date: 3/13/14
 * Time: 12:01 PM
 */

namespace Time\TrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Routing\RouterInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations;


class EnvoyerTokenController extends Controller{

    public function postEnvoyerTokenAction(Request $request)
    {

            $em = $this->getDoctrine()->getManager();

            $user = $em->getRepository('TimeTrackerBundle:User')->findALL();

            return $user;

    }



    private function EnvoyerToken()
    {

        $em = $this->getDoctrine()->getManager();

        $envoyer = $em->getRepository('TimeTrackerBundle:Token')->findAll();

        return $envoyer;

    }

} 