<?php
echo "<h1>Multiton<sub style='font-size: 10px;'>(anti-pattern)</sub></h1>";

const INSTANCE_1 = 'debug_error';
const INSTANCE_2 = 'show_message';

final class Multiton
{
    private static $instances = [];

    private function __construct() {

    }
    
    static function getInstance(string $key): Multiton
    {
        if ( ! isset(self::$instances[ $key ])) {
            self::$instances[ $key ] = new self();
        }

        return self::$instances[ $key ];
    }

    private function __clone() {

    }

    private function __wakeup() {

    }
}

$multiton1 = Multiton::getInstance(INSTANCE_1);
echo "Multiton 1 added (debug_error)";
echo "<br>";

$multiton2 = Multiton::getInstance(INSTANCE_2);
echo "Multiton 2 added (show_message)";
echo "<br><br>";

echo "Multiton 1 == Multiton 2 : " . (($multiton1 === $multiton2) ? 'True' : 'False');
echo "<br><br>";

$multiton3 = Multiton::getInstance(INSTANCE_1);
echo "Multiton 3 added (debug_error)";
echo "<br>";

$multiton4 = Multiton::getInstance(INSTANCE_2);
echo "Multiton 4 added (show_message)";
echo "<br><br>";

echo "Multiton 1 == Multiton 3 : " . (($multiton1 === $multiton3) ? 'True' : 'False');
echo "<br>";

echo "Multiton 2 == Multiton 4 : " . (($multiton2 === $multiton4) ? 'True' : 'False');
echo "<br>";