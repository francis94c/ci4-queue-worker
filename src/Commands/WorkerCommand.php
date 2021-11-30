<?php

namespace Francis94c\CI4QueueWorker\Commands;

use Exception;
use CodeIgniter\CLI\BaseCommand;

class WorkerCommand extends BaseCommand
{
    protected $group       = 'Workers';
    protected $name        = 'queue:work';
    protected $description = 'Starts listening for and ready to execute job(s) on currently configured interface.';

    public function run(array $params)
    {
        $configClassName  = \Config\Queue::class;
        if (!class_exists($configClassName)) {
            throw new Exception('Queue Config File not Found!');
        }

        $config = new $configClassName();

        $workerClassName = null;

        switch ($config->driver) {
            case 'redis':
                if (class_exists(\Redis::class)) {
                    $workerClassName = \Francis94c\CI4QueueWorker\Drivers\Redis\Worker::class;
                }
                break;
        }

        if ($workerClassName === null) {
            throw new Exception("Requirement(s) for Queue Driver '$config->driver' not met!");
        }

        $worker = new $workerClassName();
        $worker->work($config);
    }
}
