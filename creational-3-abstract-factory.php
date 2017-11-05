<?php
echo "<h1>Abstract Factory</h1>";

interface DoorFactory{
    public function makeDoor(): Door;
    public function makeExpert(): Expert;
}

class WoodenDoorFactory implements DoorFactory
{
    public function makeDoor(): Door
    {
        return new WoodenDoor;
    }
    public function makeExpert(): Expert
    {
        return new WoodenDoorExpert;
    }
}

class IronDoorFactory implements DoorFactory
{
    public function makeDoor(): Door
    {
        return new IronDoor;
    }
    public function makeExpert(): Expert
    {
        return new IronDoorExpert;
    }
}

interface Door
{
    public function getDescription();
}

class WoodenDoor implements Door
{
    public function getDescription()
    {
        echo "I'm a wooden door";
    }
}

class IronDoor implements Door
{
    public function getDescription()
    {
        echo "I'm a iron door";
    }
}

interface Expert
{
    public function getDescription();
}

class WoodenDoorExpert implements Expert
{
    public function getDescription()
    {
        echo "I can only fit wooden doors";
    }
}

class IronDoorExpert implements Expert
{
    public function getDescription()
    {
        echo "I can only fit iron doors";
    }
}

$woodenFactory = new WoodenDoorFactory();
$door = $woodenFactory->makeDoor();
$expert = $woodenFactory->makeExpert();

$door->getDescription(); // Output: I'm a wooden door
echo "<br>";

$expert->getDescription(); // Output: I can only fit wooden doors
echo "<br>";

$ironDoor = new IronDoorFactory();
$door = $ironDoor->makeDoor();
$expert = $ironDoor->makeExpert();

$door->getDescription(); // Output: I'm a iron door
echo "<br>";

$expert->getDescription(); // Output: I can only fit iron doors
echo "<br>";
