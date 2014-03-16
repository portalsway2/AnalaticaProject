<?php
/**
 * Created by PhpStorm.
 * User: portalsway3
 * Date: 2/18/14
 * Time: 9:33 PM
 */

namespace Time\TrackerBundle\Entity;



class Task
{
    protected $task;

    protected $dueDate;

    public function getTask()
    {
        return $this->task;
    }
    public function setTask($task)
    {
        $this->task = $task;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }
    public function setDueDate(\DateTime $dueDate = null)
    {
        $this->dueDate = $dueDate;
    }
}