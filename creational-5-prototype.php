<?php
echo "<h1>Prototype</h1>";

class Sheep
{
    private $name;
    private $category;

    public function __construct(string $name = '', string $category = 'Mountain Sheep')
    {
        $this->name = $name;
        $this->category = $category;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getCategory()
    {
        return $this->category;
    }
    
    public function setCategory(string $category)
    {
        $this->category = $category;
    }
}

$original = new Sheep('Jolly');
echo $original->getName(); // Jolly
echo "<br>";

echo $original->getCategory(); // Mountain Sheep
echo "<br>";

$cloned = clone $original;
$cloned->setName('Dolly');
echo $cloned->getName(); // Dolly
echo "<br>";

echo $cloned->getCategory(); // Mountain Sheep
echo "<br>";
