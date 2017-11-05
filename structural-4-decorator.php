<?php
echo '<h1>Decorator</h1>';

abstract class Coffee
{
    public $cost;
    public $description;

    public function getCost(): float {
        return $this->cost;
    }
    public function getDescription(): string {
        return $this->description;
    }
}

class SimpleCoffee extends Coffee
{
    public function __construct()
    {
        $this->cost = 10;
        $this->description = 'Simple Coffee';
    }
}

class MilkShake extends Coffee
{
    public function __construct(Coffee $coffee)
    {
        $this->cost = $coffee->cost + 2;
        $this->description = $coffee->description . ', milk';
    }
}

class WhipCoffee extends Coffee
{
    public function __construct(Coffee $coffee)
    {
        $this->cost = $coffee->cost + 5;
        $this->description = $coffee->description . ', whip';
    }
}

class VanillaCoffee extends Coffee
{
    public function __construct(Coffee $coffee)
    {
        $this->cost = $coffee->cost + 3;
        $this->description = $coffee->description . ', vanilla';
    }
}

$someCoffee = new SimpleCoffee();
echo $someCoffee->getCost(); // 10
echo "<br>";
echo $someCoffee->getDescription(); // Simple Coffee
echo "<br>";

$someCoffee = new MilkShake($someCoffee);
echo $someCoffee->getCost(); // 12
echo "<br>";
echo $someCoffee->getDescription(); // Simple Coffee, milk
echo "<br>";

$someCoffee = new WhipCoffee($someCoffee);
echo $someCoffee->getCost(); // 17
echo "<br>";
echo $someCoffee->getDescription(); // Simple Coffee, milk, whip 
echo "<br>";

$someCoffee = new VanillaCoffee($someCoffee);
echo $someCoffee->getCost(); // 20
echo "<br>";
echo $someCoffee->getDescription(); // Simple Coffee, milk, whip, vanilla
echo "<br>";
