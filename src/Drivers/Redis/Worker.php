<?php

namespace Francis94c\CI4QueueWorker\Drivers\Redis;

use Francis94c\CI4QueueWorker\Interfaces\WorkerDriver;

class Worker implements WorkerDriver
{
    public function work(\Config\Queue $config)
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
        while (true) {
        }
        // $redis->lPush('queue', 'test1');
        // $redis->lPush('queue', 'test2');
        // print($redis->iLen('queue'));
        // print_r($redis->blPop('queue', 10));
        // print_r($redis->blPop('queue', 10));
    }
}
