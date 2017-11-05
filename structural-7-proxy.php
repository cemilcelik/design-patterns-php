<?php
echo "<h1>Proxy</h1>";

interface Door
{
    public function open();
    public function close();
}

class LabDoor implements Door
{
    public function open()
    {
        echo 'Opening lab door.';
    }
    
    public function close()
    {
        echo 'Closing lab door.';
    }
}

class Security
{
    private $door;

    public function __construct(Door $door)
    {
        $this->door = $door;
    }

    public function open(string $password)
    {
        if ($this->auth($password)) {
            $this->door->open();
        }else{
            echo 'Big No! It ain\'t possible.';
        }
    }

    public function auth($password)
    {
        return $password === '$ecr@t';
    }

    public function close()
    {
        $this->door->close();
    }
}

$door = new Security(new LabDoor());

$door->open('invalid'); // Big No! It ain't possible.
echo "<br>";

$door->open('$ecr@t');  // Opening lab door.
echo "<br>";

$door->close(); // Closing lab door.
echo "<br>";