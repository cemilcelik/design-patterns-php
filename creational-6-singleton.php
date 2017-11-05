<?php
echo "<h1>Singleton</h1>";

final class President
{
    static $instance;

    private function __construct()
    {
        // Hide
    }

    static function getInstance(): President
    {
        if ( ! self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __clone()
    {
        // Disabe clone
    }

    private function __wakeup()
    {
        // Disable unseralize
    }
}

$president1 = President::getInstance();
$president2 = President::getInstance();

var_dump($president1 == $president2);
