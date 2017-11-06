<?php
echo "<h1>Command</h1>";

interface Command
{
    public function __construct(Bulb $bulb);
    public function execute();
    public function undo();
    public function redo();
}

// Command
class TurnOn implements Command
{
    private $bulb;

    public function __construct(Bulb $bulb)
    {
        $this->bulb = $bulb;
    }

    public function execute()
    {
        $this->bulb->turnOn();
    }

    public function undo()
    {
        $this->bulb->turnOff();
    }

    public function redo()
    {
        $this->bulb->execute();
    }
}

// Command
class TurnOff implements Command
{
    private $bulb;

    public function __construct(Bulb $bulb)
    {
        $this->bulb = $bulb;
    }

    public function execute()
    {
        $this->bulb->turnOff();
    }

    public function undo()
    {
        $this->bulb->turnOn();
    }

    public function redo()
    {
        $this->bulb->execute();
    }
}

// Receiver
class Bulb
{
    public function turnOn()
    {
        echo 'Bulb has been lit!';
        echo "<br>";
    }
    
    public function turnOff()
    {
        echo 'Darkness';
        echo "<br>";
    }
}

// Invoker
class RemoteControl
{
    public function submit(Command $command)
    {
        $command->execute();
    }
}

$bulb = new Bulb();

$turnOn = new TurnOn($bulb);
$turnOff = new TurnOff($bulb);

$remoteControl = new RemoteControl();

$remoteControl->submit($turnOn); // Bulb has been lit!
$remoteControl->submit($turnOff); // Darkness