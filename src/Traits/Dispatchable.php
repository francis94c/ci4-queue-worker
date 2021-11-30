<?php

namespace Francis94c\CI4QueueWorker;

trait Dispatchable
{
    public function dispatch(\Francis94c\CI4QueueWorker\Interfaces\Job $job)
    {
        (new \Francis94c\CI4QueueWorker\Dispatcher)->dispatch($job);
    }
}