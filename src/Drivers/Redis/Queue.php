<?php

namespace Francis94c\CI4QueueWorker\Drivers\Redis;

class Queue
{
    public function queue(\Francis94c\CI4QueueWorker\Interfaces\Job $job, \Config\Queue $config)
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);

        $redis->rPush($config->queue ?? 'queue', serialize($job));

        $redis->close();
    }
}