<?php
/**
 * Created by PhpStorm.
 * User: portalsway3
 * Date: 4/22/14
 * Time: 1:09 PM
 */

namespace Time\TrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 * @package Time\TrackerBundle\Controller
 */
class DefaultController extends Controller

{

    public function baseAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TimeTrackerBundle:User')->find($id);

        return array(
            'entity' => $entity,

        );
    }
} 