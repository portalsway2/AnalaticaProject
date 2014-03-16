<?php
/**
 * Created by JetBrains PhpStorm.
 * User: pw2
 * Date: 1/27/14
 * Time: 6:56 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Time\TrackerBundle\Controller;
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
use Time\TrackerBundle\Entity\Session;
use Time\TrackerBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class UsersController extends Controller
{
    /**
     * List all users.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @return array
     * @Rest\View
     */
    public function getUsersAction()
    {
        $users = $this->getDoctrine()->getRepository('TimeTrackerBundle:User')->findAll();
        return array('users' => $users);

    }


    /**
     *
     * get user by id
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @param int $userId
     * @return array
     * @Rest\View
     */
    public function getUserAction($userId)
    {
        $user = $this->getDoctrine()->getRepository('TimeTrackerBundle:User')->find($userId);
        return array('user' => $user,);

    }

    /**
     * post new user
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     * )
     * @return array
     */
    public function postUserAction()
    {
        $request = $this->getRequest();


        $user = new User();
        $user->setPassword($request->get('pass'));
        $user->setUsername($request->get('username'));
        $user->setEmail($request->get('email'));


        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return array("Created user id " => $user->getId(),
            "request 1" => $request->getClientIp(),);


    }


    /**
     *
     * Get user Agent
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @param Request $request
     * @return array
     */
    public function postUseragentAction(Request $request)
    {


        $Useragent = $request->get('useragent');

        $nav = "11";
        $os = "11";
        $version = "11";


        return (array(

            "useragent" =>$request->get('useragent')

        ));


    }

    /**
     *  Update existing user
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     201 = "Returned when the User is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @param int $userId
     * @return array
     */
    public function putUserAction($userId)
    {
        $request = $this->getRequest();
        $user = $this->getDoctrine()->getRepository('TimeTrackerBundle:User')->find($userId);
        if ($request->get('pass')) {
            $user->setPassword($request->get('pass'));
        }
        if ($request->get('username')) {
            $user->setUsername($request->get('username'));
        }
        if ($request->get('email')) {
            $user->setEmail($request->get('email'));
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return array("User " => $user,
            "request 1" => $request->getClientIp(),);

    }


    /**
     *  Delete existing user
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     201 = "Returned when the Page is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @param int $userId
     */
    public function deleteUserAction($userId)
    {
        $user = $this->getDoctrine()->getRepository('TimeTrackerBundle:User')->find($userId);
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

    }


    /**
     * Connexion to Server
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     201 = "Returned when the Page is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @param $id
     * @param Request $request
     * @return array
     */
    public function postSessionAction($id, Request $request)
    {

        $user = $this->getDoctrine()->getRepository('TimeTrackerBundle:User')->find($id);
        if ($request->get('pass')) {
            $pass = $request->get('pass');
            if ($user->getPassword() == $pass) {

                //TODO

                $session = new Session();
                $session->setUserId($id);
                //        $session->setCreatedAt(1231634282);
//        $session->setExpireAt(1231634282);
                $session->setSession("lkj544ddàç_-sqdojlqs@sqhs6565....");
                $session->setSecureSession("lkjlzakljljdfljsdlkj=à)à");
                $session->setInfo("msdkmlsdsdf");

                $em = $this->getDoctrine()->getManager();
                $em->persist($session);
                $em->flush();


                //TODO
                return array("connexion" => "success");

            } else {
                return array("connexion" => "connexion failed..");
            }
        } else {
            return array(
                "connexion" => "connexion dined ",

            );
        }


    }

    /**
     * Connexion to Server
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     201 = "Returned when the Page is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @param Request $request
     * @return array
     */
    public function putLogin_clientAction(Request $request)
    {
        $pass = $request->server->get("HTTP_PASS");
        $username = $request->server->get("HTTP_USERNAME");
        $id = $request->server->get("HTTP_USERID");
        $userArray = $this->getDoctrine()->getRepository('TimeTrackerBundle:User')->findby(array("username" => $username));
        $user = $userArray[0];
        if ($pass & $username) {

            if ($user->getPassword() == $pass) {

                //TODO


                $sessionArray = $this->getDoctrine()->getRepository('TimeTrackerBundle:Session')->findby(array("userId" => $user->getID()));
                if ($sessionArray) {
                    $session=$sessionArray[0];
                    $sessionuser = new Session1();
                    $sessionuser->start();
                    $sessionuser->set('name', 'Drak');

                    return array(
                        "connexion" => "session opened",
                        "session"   =>$sessionuser->get('name')

                    );

                } else {



                    $session = new Session();
                    $session->setUserId($id);
                    //        $session->setCreatedAt(1231634282);
//        $session->setExpireAt(1231634282);
                    //TODO create methods generate code session and secure session
                    $session->setSession("lkj544ddàç_-sqdojlqs@sqhs6565....");
                    $session->setSecureSession("lkjlzakljljdfljsdlkj=à)à");
                    $session->setInfo("msdkmlsdsdf");

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($session);
                    $em->flush();


                    //TODO change the return request
                    return array(
                        "connexion" => "success",
                        "session" => $session->getSession()
                    );

                }
            } else {
                return array(
                    "connexion" => "connexion failed..",
                    "session"   =>"NULL"
                );
            }
        } else {
            return array(
                "connexion" => "impossible to find the password or the user name !!",
                "session"   =>"NULL"

            );
        }


    }
    public function CreateSession(){

    }


}