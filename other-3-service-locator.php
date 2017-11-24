<?php
echo "<h1>Service Locator<sub style='font-size: 10px;'>(anti-pattern)</sub></h1>";

class ServiceLocator
{
    private $services = [];
    private $instantiated = [];
    private $shared = [];
    
    public function __construct()
    {
        # code...
    }

    public function addInstance(string $class, $object, bool $share = true)
    {
        $this->services[$class]     = $object;
        $this->instantiated[$class] = $object;
        $this->shared[$class]       = $share;
    }

    public function addClass(string $class, array $params, bool $share = true)
    {
        $this->services[$class] = $params;
        $this->shared[$class]   = $share;
    }

    public function has(string $class)
    {
        if (isset($this->services[$class]) && isset($this->shared[$class])) {
            return true;
        }
        return false;
    }

    public function get(string $class)
    {
        if (isset($this->instantiated[$class]) && isset($this->shared[$class])) {
            return $this->instantiated[$class];
        }

        $args = $this->services[$class];

        switch (count($args)) {
            case 0: 
                $object = new $class();
                break;
            case 1: 
                $object = new $class($arg[0]);
                break;
            case 2: 
                $object = new $class($arg[0], $arg[1]);
                break;
            case 3: 
                $object = new $class($arg[0], $arg[1], $arg[2]);
                break;
            default:
                throw new \Exception('Too many arguments given!');
        }

    }
}

class Logger
{

}

class Mailer
{

}

$serviceLocator = new ServiceLocator();

$serviceLocator->addInstance(Logger::class, new Logger());
echo "<u>Logger::class</u> ve <u>instance</u> eklendi.";
echo "<br>";

echo "Logger::class sahiptir (has): " . (($serviceLocator->has(Logger::class)) ? 'True' : 'False');
echo "<br>";

$object = $serviceLocator->get(Logger::class);
echo "Logger::class getir (get) == Instanceof Logger: " . (($object instanceof Logger) ? 'True' : 'False');
echo "<br>";

echo "<br>";

$serviceLocator->addClass(Mailer::class, []);
echo "<u>Mailer::class</u> eklendi.";
echo "<br>";

echo "Mailer::class sahiptir (has): " . (($serviceLocator->has(Mailer::class)) ? 'True' : 'False');
echo "<br>";

$object = $serviceLocator->get(Mailer::class);
echo "Mailer::class getir (get) == Instanceof Mailer: " . (($object instanceof Mailer) ? 'True' : 'False');
