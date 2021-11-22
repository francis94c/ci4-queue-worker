<?php

namespace Francis94c\CI4QueueWorker\Interfaces;

interface WorkerDriver
{
    public function work(\Config\Queue $config);
}
