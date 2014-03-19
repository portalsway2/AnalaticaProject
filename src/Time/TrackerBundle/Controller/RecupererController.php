<?php
/**
 * Created by PhpStorm.
 * User: portalsway3
 * Date: 3/7/14
 * Time: 10:37 PM
 */

namespace Time\TrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Routing\RouterInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations;

class RecupererController extends Controller
{


    public function postRecupererAction(Request $request)
    {

        $urlparam = $request->server->getHeaders();
        $token = $urlparam["TOKEN"];
        $navigateur = $this->FindNavigateur();
        $systeme = $this->FindOS();
        $user = $this->FindToken($token);
        $envoyer = $this->EnvoyerToken();

        if ($user) {
            return (array(

                "navigateur" => $navigateur,
                "systeme" => $systeme,
                "envoyer" => $envoyer,

            ));

        } else {
            return (array(

                "navigateur" => null,
                "systeme" => null,

            ));
        }

    }

    private function FindToken($token)
    {

        {
            $em = $this->getDoctrine()->getManager();

            $user = $em->getRepository('TimeTrackerBundle:User')->findBy(array('token' => $token));

            return $user[0];
        }

    }

    private function FindNavigateur()
    {

        {
            $em = $this->getDoctrine()->getManager();

            $navigateur = $em->getRepository('TimeTrackerBundle:Navigateur')->findAll();

            return $navigateur;
        }

    }

    private function FindOS()
    {

        $em = $this->getDoctrine()->getManager();

        $systeme = $em->getRepository('TimeTrackerBundle:OS')->findAll();

        return $systeme;

    }

    private function EnvoyerToken()
    {

        $em = $this->getDoctrine()->getManager();

        $envoyer = $em->getRepository('TimeTrackerBundle:Token')->findAll();

        return $envoyer;

    }

} 