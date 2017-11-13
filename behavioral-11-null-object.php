<?php
echo "<h1>Null Object<sub style='font-size: 10px;'>(not-gof-pattern)</sub></h1>";

interface ILogger
{
    public function log(string $msg);
}

class NullLogger implements ILogger
{
    public function log(string $msg)
    {
        // null
    }
}

class PrintLogger implements ILogger
{
    public function log(string $msg)
    {
        echo '$msg is equal: ' . $msg;
        echo "<br>";
        echo 'We are in "' . __METHOD__ . '" named method.';
    }
}

class Service
{
    private $logger;

    public function __construct(ILogger $logger)
    {
        $this->logger = $logger;
    }

    public function log(string $msg)
    {
        $this->logger->log($msg);
    }
}

$service1 = new Service(new NullLogger());
$service1->log('');

$service2 = new Service(new PrintLogger());
$service2->log('Service2 message.');