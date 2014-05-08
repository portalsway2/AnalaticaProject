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
     * This is a description of your API method Recover User by Token
     *
     * **Response format**
     *
     *    {
     *
     *       "user":[
     *
     *            "credentials_expired":"false",
     *            "email":"emailgmail.com",
     *            "email_canonical":"emailgmail.com",
     *            "enabled":"true",
     *            "expired": "false",
     *            "first_name": "firstname",
     *            "id": 1,
     *            "last_login": "2014-05-08T00:40:40+0100",
     *            "last_name": "lastname",
     *            "locked": false,
     *            "password": "password",
     *            "roles": [],
     *            "salt": "salt",
     *            "token": "token",
     *            "username": "usename",
     *            "username_canonical": "usernamecanonical"
     *
     *        ]
     *    }
     *
     * @ApiDoc(
     *   section = "user",
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the page is not found"
     *   }
     * )
     *
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
     * @ApiDoc(
     *   section = "user agent",
     *   resource = true,
     *   output = "Time\TrackerBundle\Entity\UserAgent",
     *   parameters={
     *      {"name"="nbruseragent", "dataType"="integer", "required"=true, "description"="category id"}
     *  }
     * )
     * @param string $token the user id
     * @return array
     */

    public function getUserAgentAction($token)
    {

        $em = $this->getDoctrine()->getManager();

        $useragent = $em->getRepository('TimeTrackerBundle:UserAgent')->findBy(array("token" => $token));

        return array("useragent" => $useragent);


    }


    /**
     *   Get Forfait
     *
     * @ApiDoc(
     *   section = "forfait",
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the page is not found"
     *   }
     * )
     * @param $id
     * @return array
     */
    public function getForfaitAction($id)
    {


        $forfaituser = $this->getDoctrine()
            ->getRepository('TimeTrackerBundle:ForfaitUser')
            ->find($id);

        $userToken = $forfaituser->getUser()->getToken();

    }
}