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
     * This is a description of your API method Recover User Agent by Token
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
     *
     *   Get forfeit
     *
     * @ApiDoc(
     *   section = "forfeit",
     *   resource = true,
     *   output = "Time\TrackerBundle\Entity\Forfait",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the page is not found"
     *   }
     * )
     * @return array
     */
    public function getForfeitAction()
    {

        $em = $this->getDoctrine()->getManager();

        $forfait = $em->getRepository('TimeTrackerBundle:Forfait')->findALL();

        return array("forfait" => $forfait);

    }

    /**
     *   Get forfeit User by Token
     *
     * @ApiDoc(
     *   section = "forfeit User",
     *   resource = true,
     *   output = "Time\TrackerBundle\Entity\ForfaitUser",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the page is not found"
     *   }
     * )
     *
     * @param $token
     * @return array
     */
    public function getForfeitUserAction($token)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('TimeTrackerBundle:User')->findBy(array("token" => $token));

        $userforfait = $em->getRepository('TimeTrackerBundle:ForfaitUser')->findBy(array("iduser" => $user[0]));

        return array(
            'userforfait' => $userforfait
        );
    }

}
