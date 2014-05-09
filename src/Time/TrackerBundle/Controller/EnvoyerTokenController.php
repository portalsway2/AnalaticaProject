<?php
/**
 * Created by PhpStorm.
 * User: portalsway3
 * Date: 3/13/14
 * Time: 12:01 PM
 */

namespace Time\TrackerBundle\Controller;

use Doctrine\ORM\Tools\Pagination\Paginator;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\QueryParam;
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
     *            "email":" your e_mail",
     *            "email_canonical":" your e_mail_canonical",
     *            "enabled":"true",
     *            "expired": "false",
     *            "first_name": " you first name",
     *            "id": 1,
     *            "last_login": "2014-05-08T00:40:40+0100",
     *            "last_name": " your last name",
     *            "locked": false,
     *            "password": "password",
     *            "roles": [],
     *            "salt": "salt",
     *            "token": "token",
     *            "username": "user name",
     *            "username_canonical": "user_name_canonical"
     *
     *        ]
     *    }
     *
     * @ApiDoc(
     *   section = "user",
     *   resource = true,
     *  output = "Time\TrackerBundle\Entity\User",
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
     *   output = "Time\TrackerBundle\Entity\UserAgent"
     * )
     *
     * @QueryParam(name="max")
     * @QueryParam(name="page")
     * @param string $token
     * @param ParamFetcher $paramFetcher
     * @return array
     */
    public function getUserAgentAction(ParamFetcher $paramFetcher, $token)
    {
        $max = $paramFetcher->get("max");
        $page = $paramFetcher->get("page");
        $fistResult = ($page - 1) * $max;
        $repository = $this->getDoctrine()->getRepository('TimeTrackerBundle:UserAgent');
        $query = $repository->createQueryBuilder('u')
            ->where('u.token =:to')
            ->setParameter('to', $token)
            ->getQuery();
        $pagination = new Paginator($query);
        $ResultUserAgent = $query->setMaxResults($max)->setFirstResult($fistResult)->getResult();


        return array("useragent" => $ResultUserAgent);


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
     * @return array
     */
    public function getForfaitAction()
    {

        $em = $this->getDoctrine()->getManager();

        $forfait = $em->getRepository('TimeTrackerBundle:Forfait')->findALL();

        return array("forfait" => $forfait);

    }

    /**
     *   Get Forfait User
     *
     * @ApiDoc(
     *   section = "forfait User",
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the page is not found"
     *   }
     * )
     *
     * @param $token
     * @return array
     */


    public function getForfaitUserAction($token)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('TimeTrackerBundle:User')->find($token);

        $userforfait = $em->getRepository('TimeTrackerBundle:ForfaitUser')->find($token);

        return array(
            'user' => $user,
            'userforfait' => $userforfait
        );
    }

}
