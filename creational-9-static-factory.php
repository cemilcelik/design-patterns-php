<?php
echo "<h1>Static Factory</h1>";

final class StaticFactory
{
    public static function factory(string $type): IFormatter
    {
        if ($type == 'integer') {
            return new IntegerFormatter();
        }
        if ($type == 'string') {
            return new StringFormatter();
        }

        throw new \InvalidArgumentException('Unknown format given');
    }
}

interface IFormatter
{
    public function __construct();
}

class IntegerFormatter implements IFormatter
{
    public function __construct()
    {
        echo "Integer formatter created.";
        echo "<br>";
    }
}

class StringFormatter implements IFormatter
{
    public function __construct()
    {
        echo "String formatter created.";
        echo "<br>";
    }
}

StaticFactory::factory('integer');
StaticFactory::factory('string');
