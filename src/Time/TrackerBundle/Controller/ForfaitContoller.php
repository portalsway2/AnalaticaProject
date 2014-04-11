<?php
/**
 * Created by PhpStorm.
 * User: portalsway3
 * Date: 4/5/14
 * Time: 3:41 PM
 */

namespace Time\TrackerBundle\Controller;


/**
 * Class ForfaitContoller
 * @package Time\TrackerBundle\Controller
 */
class ForfaitContoller  extends Controller
{

    /**
     * @Route("forfait/{id}", name="forfait")
     * @Method("GET")
     * @Template("TimeTrackerBundle:Agent:forfait.html.twig")
     */
    public function showAction()
    {

        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('TimeTrackerBundle:Forfait');

        $listeForfait = $repository->findAll();
        return array('forfait'=>$listeForfait);

    }



} 