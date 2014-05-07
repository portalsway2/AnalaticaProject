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
     *
     * Get user
     *
     * @ApiDoc(
     *  requirements={
     *      {
     *     "name"=" token ",
     *     "dataType"="string",
     *     "requirement"="Header",
     *     "description"=" findBy token"
     *   }
     * },
     *   resource = true,
     *   statusCodes = {
     *
     *   }
     * )
     *
     * @param $token
     * @return array
     */


    public function getUserAction($token)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('TimeTrackerBundle:User')->findBy(array("token" => $token));

        return array("user" => $user);


    }


    /**
     *
     * Get User Agent
     *
     * @ApiDoc(
     *  requirements={
     *      {
     *     "name"=" token ",
     *     "dataType"="string",
     *     "requirement"="Header",
     *     "description"=" findBy token"
     *   }
     * },
     *   resource = true,
     *   statusCodes = {
     *
     *   }
     * )
     *
     * @param $token
     * @return array
     */
    public function getUserAgentAction($token)
    {

        $em = $this->getDoctrine()->getManager();

        $useragent = $em->getRepository('TimeTrackerBundle:UserAgent')->findBy(array("token" => $token));

        return array("useragent" => $useragent);


    }


}