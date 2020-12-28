<?php

namespace Francis94c\CI4QueueWorker\Commands;

use CodeIgniter\CLI\BaseCommand;

class WorkerCommand extends BaseCommand
{
    protected $group       = 'Workers';
    protected $name        = 'queue:work';
    protected $description = 'Starts listening for and ready to exexute job(s) on currently configured interface.';

    public function run(array $params)
    {
    }
}
