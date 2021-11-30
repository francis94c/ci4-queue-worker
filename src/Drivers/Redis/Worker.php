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

            // Attempt to Un-Serialize a Job Object.
            $job = unserialize($jobData[1] ?? null);

            if ($job) {
                CLI::write('Executing Job: ' . get_class($job), 'green');
                try {
                    $job->handle();
                } catch (Exception $e) {
                    CLI::write('An Error Occurred: ' . $e->getMessage(), 'red');
                    $redis->rPush($config->failedQueue ?? 'failed_jobs', $jobData[1]);
                    CLI::write('Job Failed and Moved to Failed Queue', 'red');
                }
            }

            sleep($config->sleep ?? 3);
        }
    }
}
