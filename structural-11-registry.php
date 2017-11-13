<?php
echo "<h1>Registry<sub style='font-size: 10px;'>(anti-pattern)</sub></h1>";

class Registry
{
    const LOGGER = 'logger';

    private static $storedValues = [];
    private static $allowedKeys = [
        self::LOGGER
    ];

    public static function get($key)
    {
        if (!in_array($key, self::$allowedKeys)) {
            throw new \InvalidArgumentException('Invalid key given');
        }
        if (!isset(self::$storedValues[$key])) {
            throw new \InvalidArgumentException('Key not set yet');
        }

        return self::$storedValues[$key];
    }

    public static function set($key, $value)
    {
        if (!in_array($key, self::$allowedKeys)) {
            throw new \InvalidArgumentException('Invalid key given');
        }
        self::$storedValues[$key] = $value;
    }
}

$key = Registry::LOGGER;
$logger = new stdClass();

try {
    Registry::get($key);
} catch (Exception $e) {
    echo $e->getMessage();
    echo "<br>";
}

Registry::set($key, $logger);
$storedLogger = Registry::get($key);

echo '$logger === $storedLogger: ' . (($logger === $storedLogger) ? 'True' : 'False');
echo "<br>";

echo '$storedLogger is an istance of stdClass: ' . (($storedLogger instanceof stdClass) ? 'True' : 'False');
echo "<br>";

try{
    Registry::set('foober', $logger);
} catch (Exception $e) {
    echo $e->getMessage();
    echo "<br>";
}