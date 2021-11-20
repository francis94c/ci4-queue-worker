<?php

namespace Francis94c\CI4QueueWorker\Commands;

use CodeIgniter\CLI\BaseCommand;

class WorkerCommand extends BaseCommand
{
    protected $group       = 'Workers';
    protected $name        = 'queue:work';
    protected $description = 'Starts listening for and ready to execute job(s) on currently configured interface.';

    public function run(array $params)
    {
        echo gearman_version() . PHP_EOL;
        // $worker = new GearmanWorker();
        // $worker->addServer();
        // $worker->addFunction("reverse", function ($job) {
        //     return strrev($job->workload());
        // });
        // while ($worker->work());
    }
}
