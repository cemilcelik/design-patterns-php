<?php
echo "<h1>Simple Factory</h1>";

interface Door {
    public function getWidth(): float;
    public function getHeight(): float;
}

class WoodenDoor implements Door
{
    protected $width;
    protected $height;

    public function __construct(float $width, float $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }
}

class DoorFactory
{
    static function makeDoor($width, $height): Door
    {
        return new WoodenDoor($width, $height);
    }
}

$door = DoorFactory::makeDoor(100, 200);

echo "Width: " . $door->getWidth();
echo "<br>";

echo "Height: " . $door->getHeight();
echo "<br>";
