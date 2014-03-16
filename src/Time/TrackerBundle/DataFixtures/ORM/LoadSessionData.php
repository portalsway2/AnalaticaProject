<?php
/**
 * Created by JetBrains PhpStorm.
 * User: pw2
 * Date: 1/27/14
 * Time: 12:04 PM
 * To change this template use File | Settings | File Templates.
 */


namespace Time\TrackerBundle\DataFixtures\ORM;
use DateTime;
use Doctrine\Common\DataFixtures\FixtureInterface;

use Doctrine\Common\DataFixtures\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Time\TrackerBundle\Entity\Session;
use Time\TrackerBundle\Entity\User;


class LoadSessionData implements FixtureInterface{

    /**
     * Load data fixtures with the passed EntityManager
     *
     */
    function load(ObjectManager $manager)
    {



    }
}