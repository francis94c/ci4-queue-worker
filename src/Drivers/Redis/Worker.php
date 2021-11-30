<?php

namespace Francis94c\CI4QueueWorker\Drivers\Redis;

use CodeIgniter\CLI\CLI;
use Exception;
use Francis94c\CI4QueueWorker\Interfaces\WorkerDriver;

class Worker implements WorkerDriver
{
    public function work(\Config\Queue $config)
    {
        $redis = new \Redis();

        $redis->connect('127.0.0.1', 6379);

        while (true) {
            // Fetch a job from the queue.
            $jobData = $redis->blPop($config->queue ?? 'queue', 2);
            $job = unserialize($jobData[1] ?? null);

            if ($job) {
                try {
                    $job->handle();
                } catch (Exception $e) {
                    CLI::error($e->getMessage());
                    $redis->rPush($config->failedQueue ?? 'failed_jobs', $jobData[1]);
                }
            }

            sleep($config->sleep ?? 3);
        }
        // $redis->lPush('queue', 'test1');
        // $redis->lPush('queue', 'test2');
        // print($redis->iLen('queue'));
        // print_r($redis->blPop('queue', 10));
        // print_r($redis->blPop('queue', 10));
    }
}
