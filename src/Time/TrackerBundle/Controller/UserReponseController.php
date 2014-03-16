<?php
/**
 * Created by PhpStorm.
 * User: portalsway3
 * Date: 2/4/14
 * Time: 12:15 PM
 */

namespace Time\TrackerBundle\Controller;


use Symfony\Component\HttpFoundation\Session\Session as Session1;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations;


class UserReponseController extends Controller
{
    public function getUserResponseAction(Response $response)
    {

        $UserResponse= $response->get('UserResponse');

        $nav = "mozilla";
        $os = "Linux";
        $version = "4.2";


        return (array(

            "UserResponse" =>$response->get('UserResponse')

        ));


    }
} 