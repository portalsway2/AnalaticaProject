<?php

namespace Time\TrackerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TimeTrackerBundle extends Bundle
{
    public function getParent()
    {

        return 'FOSUserBundle';
    }

}