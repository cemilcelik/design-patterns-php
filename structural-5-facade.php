<?php
echo "<h1>Facade</h1>";

class Computer
{
    public function getElectricShock()
    {
        echo "Ouch! ";
    }
    
    public function makeSound()
    {
        echo "Beep beep! ";
    }
    
    public function showLoadingScreen()
    {
        echo "Loading.. ";
    }
    
    public function bam()
    {
        echo "Ready to be used. ";
    }
    
    public function closeEverything()
    {
        echo "Bup bup buzzz! ";
    }
    
    public function pullCurrent()
    {
        echo "Haah! ";
    }
    
    public function sooth()
    {
        echo "Zzzzz ";
    }
}

class ComputerFacade
{
    private $computer;

    public function __construct(Computer $computer)
    {
        $this->computer = $computer;    
    }

    public function turnOn()
    {
        $this->computer->getElectricShock();
        $this->computer->makeSound();
        $this->computer->showLoadingScreen();
        $this->computer->bam();
    }

    public function turnOff()
    {
        $this->computer->closeEverything();
        $this->computer->pullCurrent();
        $this->computer->sooth();
    }
}

$computer = new ComputerFacade(new Computer);

$computer->turnOn(); // Ouch! Beep beep! Loading.. Ready to be used.
echo "<br>";
$computer->turnOff(); // Bup bup buzzz! Haah! Zzzzz
