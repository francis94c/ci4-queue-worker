<?php

namespace Francis94c\CI4QueueWorker;

class Dispatcher
{
    public function dispatch(\Francis94c\CI4QueueWorker\Interfaces\Job $job)
    {
        $configClassName  = \Config\Queue::class;
        if (!class_exists($configClassName)) {
            throw new \Exception('Queue Config File not Found!');
        }

        $config = new $configClassName();

        switch ($config->driver) {
            case 'redis':
                if (class_exists(\Redis::class)) {
                    $queueClassName = \Francis94c\CI4QueueWorker\Drivers\Redis\Queue::class;
                }
                break;
        }

        if ($queueClassName === null) {
            throw new \Exception("Requirement(s) for Queue Driver '$config->driver' not met!");
        }

        $queue = new $queueClassName();
        
        $queue->queue($job, $config);
    }
}