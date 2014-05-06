<?php
/**
 * Created by PhpStorm.
 * User: portalsway3
 * Date: 2/4/14
 * Time: 11:44 AM
 */

namespace Time\TrackerBundle\Controller;

use Negotiation\Tests\LanguageNegotiatorTest;
use Symfony\Component\HttpFoundation\Session\Session as Session1;
use Symfony\Component\Routing\RouterInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\Validator\Constraints\Null;
use Time\TrackerBundle\Entity\ListNavigateur;
use Time\TrackerBundle\Entity\ListDevice;
use Time\TrackerBundle\Entity\Navigateur;
use Time\TrackerBundle\Entity\OS;
use Time\TrackerBundle\Entity\Device;
use Time\TrackerBundle\Entity\Session;
use Time\TrackerBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Time\TrackerBundle\Entity\UserAgent;
use Time\TrackerBundle\Entity\ListOS;


class AgentController extends Controller

{

    /**
     *
     * Post user Agent
     *
     * @ApiDoc(
     *  requirements={
     *   {
     *     "name"="token",
     *     "dataType"="string",
     *     "requirement"="Header",
     *     "description"=" return token"
     *   },
     *      {
     *     "name"="User Agent",
     *     "dataType"="string",
     *     "requirement"="Header",
     *     "description"=" return token"
     *   }
     * },
     *   resource = true,
     *   statusCodes = {
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param Request $request
     * @return array
     */

    public function postAgentAction(Request $request)
    {

        $urlparam = $request->server->getHeaders();
        $token = $urlparam["TOKEN"];
        $ip = $urlparam["IP"];
        $resultat = $this->ConverterBrowsers($urlparam['AGENT']);
        $result = $this->ConverterOS($urlparam['AGENT']);
        $mobile = $this->ConverterMobile($urlparam['AGENT']);


        // TODO tester l'existance de l'utilisateur

        $user = $this->FindToken($token);
        $ListNavigateur = $this->VerifierNavigateur($resultat['navigateur'], $resultat['version'], $user);
        $ListOS = $this->VerifierOS($result['systeme'], $result['version'], $user);
        $ListDevice = $this->VerifierDevice($mobile['name'], $mobile['version'], $user);


        if ($user) {


            // Enregistrer User Agent

            $UserAgent = new UserAgent();
            $UserAgent->setIdUser($user);
            $UserAgent->setUserAgent($urlparam['AGENT']);
            $UserAgent->setToken($token);
            $UserAgent->setCount("9");
            $UserAgent->setIp($urlparam["IP"]);
            $UserAgent->setDate(new \DateTime());
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($UserAgent);
            $em->flush();

            // Enregistrer Systeme d'exploitation

            $OS = new OS();
            $OS->setIdUserAgent($UserAgent);
            $OS->setSystem($result['systeme']);
            $OS->setVersion($result['version']);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($OS);
            $em->flush();


            // Enregistrer Device

            $Device = new Device();
            $Device->setIdUserAgent($UserAgent);
            $Device->setName($mobile['name']);
            $Device->setVersion($mobile['version']);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($Device);
            $em->flush();

            // Enregistrer Navigateur

            $Navigateur = new Navigateur();
            $Navigateur->setIdUserAgent($UserAgent);
            $Navigateur->setNavigateur($resultat['navigateur']);
            $Navigateur->setVersion($resultat['version']);


            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($Navigateur);
            $em->flush();


            return (array(

                "user" => $user->getUserName(),
                "ip" => $ip,
                "result" => $result,
                "resultat" => $resultat,
                "mobile" => $mobile,

            ));
        } else {
            return (array(

                "result" => null,
                "resultat" => null,
                "mobile" => null,
            ));
        }

    }

    /**
     * @param $userAgent
     * @return array
     */

    private function ConverterOS($userAgent)
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('TimeTrackerBundle:Regex')->findAll();

        $convert = "false";
        $systeme = "null";
        $version = "null";


        foreach ($entities as $entiy) {

            if (preg_match($entiy->getRegex(), $userAgent, $mot)) {
                if (count($mot) == 2) {
                    $version = $mot[1];
                };
                $convert = "true";
                $systeme = $mot[0];
            }

        }

        return array(

            "convert" => $convert,
            "systeme" => $systeme,
            "version" => $version,

        );

    }

    /**
     * @param $userAgent
     * @return array
     */
    private function ConverterBrowsers($userAgent)
    {

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TimeTrackerBundle:RegexBrowsers')->findAll();

        $convert = "false";
        $version = "null";
        $navigateur = "null";


        foreach ($entities as $entiy) {

            if (preg_match($entiy->getRegexbrowsers(), $userAgent, $mot)) {
                $convert = "true";
                $navigateur = $mot[0];
                $version = $mot[1];
            }

        }

        return array(

            "convert" => $convert,
            "version" => $version,
            "navigateur" => $navigateur

        );

    }

    /**
     * @param $userAgent
     * @return array
     */
    private function ConverterMobile($userAgent)
    {

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TimeTrackerBundle:RegexMobile')->findAll();

        $convert = "false";
        $name = "null";
        $version = "null";


        foreach ($entities as $entiy) {

            if (preg_match($entiy->getRegex(), $userAgent, $mot)) {
                $convert = "true";
                $name = $mot[0];
                $version = $mot[1];
            }

        }

        return array(

            "convert" => $convert,
            "name" => $name,
            "version" => $version,


        );

    }


    /**
     * @param $token
     * @return mixed
     */
    private function FindToken($token)
    {

        {
            $em = $this->getDoctrine()->getManager();

            $user = $em->getRepository('TimeTrackerBundle:User')->findBy(array('token' => $token));

            return $user[0];
        }

    }


    /**
     * @param $name
     * @param $version
     * @param $idUser
     * @return ListNavigateur
     */
    private function VerifierNavigateur($name, $version, $idUser)
    {

        {
            $em = $this->getDoctrine()->getManager();

            $ListNavigateur = $em->getRepository('TimeTrackerBundle:ListNavigateur')->findBy(array("name" => $name,
                "version" => $version, "idUser" => $idUser));

            if ($ListNavigateur) {
                $ListNavigateur[0]->setCount($ListNavigateur[0]->getCount() + 1);
                $em->flush();
                return $ListNavigateur[0];
            } else {
                $newListNavigateur = new ListNavigateur();
                $newListNavigateur->setName($name);
                $newListNavigateur->setVersion($version);
                $newListNavigateur->setIdUser($idUser);
                $newListNavigateur->setCount(1);

                $em->persist($newListNavigateur);
                $em->flush();
                return $newListNavigateur;
            }

        }

    }

    /**
     * @param $name
     * @param $version
     * @param $idUser
     * @return ListOS
     */
    private function VerifierOS($name, $version, $idUser)
    {

        {
            $em = $this->getDoctrine()->getManager();

            $ListOS = $em->getRepository('TimeTrackerBundle:ListOS')->findBy(array("name" => $name,
                "version" => $version, "idUser" => $idUser));


            if ($ListOS) {
                $ListOS[0]->setCount($ListOS[0]->getCount() + 1);
                $em->flush();
                return $ListOS[0];
            } else {
                $newListOS = new ListOS();
                $newListOS->setName($name);
                $newListOS->setVersion($version);
                $newListOS->setIdUser($idUser);
                $newListOS->setCount(1);

                $em->persist($newListOS);
                $em->flush();
                return $newListOS;
            }
        }
    }

    /**
     * @param $name
     * @param $version
     * @param $idUser
     * @return ListDevice
     */
    private function VerifierDevice($name, $version, $idUser)
    {

        {
            $em = $this->getDoctrine()->getManager();

            $ListDevice = $em->getRepository('TimeTrackerBundle:ListDevice')->findBy(array("name" => $name,
                "version" => $version, "idUser" => $idUser));


            if ($ListDevice) {
                $ListDevice[0]->setCount($ListDevice[0]->getCount() + 1);
                $em->flush();
                return $ListDevice[0];
            } else {
                $newListDevice = new ListDevice();
                $newListDevice->setName($name);
                $newListDevice->setVersion($version);
                $newListDevice->setIdUser($idUser);
                $newListDevice->setCount(1);

                $em->persist($newListDevice);
                $em->flush();
                return $newListDevice;
            }
        }
    }




}