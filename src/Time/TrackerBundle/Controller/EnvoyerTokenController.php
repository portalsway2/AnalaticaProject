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


class EnvoyerTokenController extends Controller
{

    /**
     * Get token Envoyer
     * @ApiDoc(
     *   description = "Gets a token for a given id",
     *  requirements={
     *      {
     *          "name"="lll",
     *          "dataType"="string",
     *          "description"=" return token"
     *      }
     *  },
     *  parameters={
     *      {"name"="token", "dataType"="string", "required"=true, "description"="category token"}
     *  }
     * )
     */


    public function getEnvoyerTokenAction($id)
    {

        $em = $this->getDoctrine()->getManager($id);

        $user = $em->getRepository('TimeTrackerBundle:User')->findBy(array("id" => $id));

        return ($user);

    }


    /**
     * Get user Profile
     * @ApiDoc(
     *   description = "Get profile ",
     *  requirements={
     *      {
     *          "name"="profile",
     *          "dataType"="string",
     *          "description"=" return token"
     *      }
     *  },
     *  parameters={
     *      {"name"="token", "dataType"="string", "required"=true, "description"="category token"}
     *  }
     * )
     */

    public function getProfileAction($id)
    {

        $em = $this->getDoctrine()->getManager($id);

        $user = $em->getRepository('TimeTrackerBundle:User')->findBy(array("id" => $id));

        return ($user);

    }


}