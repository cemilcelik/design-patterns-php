<?php
echo "<h1>Builder</h1>";

class Burger
{
    protected $size;
    protected $cheese = false;
    protected $pepperoni = false;
    protected $lettuce = false;
    protected $tomato = false;

    public function __construct(BurgerBuilder $builder)
    {
        $this->size = $builder->size;
        $this->cheese = $builder->cheese;
        $this->pepperoni = $builder->pepperoni;
        $this->lettuce = $builder->lettuce;
        $this->tomato = $builder->tomato;
    }

    public function getDescription()
    {
        $desc = $this->size . " inch";
        
        if ($this->cheese)      $desc .= ", with cheese";
        if ($this->pepperoni)   $desc .= ", with pepperoni";
        if ($this->lettuce)     $desc .= ", with lettuce";
        if ($this->tomato)      $desc .= ", with tomato";

        return $desc;
    }
}

class BurgerBuilder
{
    public $size;
    public $cheese = false;
    public $pepperoni = false;
    public $lettuce = false;
    public $tomato = false;

    public function __construct($size)
    {
        $this->size = $size;
    }

    public function addCheese()
    {
        $this->chesse = true;
        return $this;
    }

    public function addPepperoni()
    {
        $this->pepperoni = true;
        return $this;
    }

    public function addLettuce()
    {
        $this->lettuce = true;
        return $this;
    }

    public function addTomato()
    {
        $this->tomato = true;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function build(): Burger
    {
        return new Burger($this);
    }
}

$burger = 
    (new BurgerBuilder(14))
    ->addPepperoni()
    ->addLettuce()
    ->addTomato()
    ->build();

echo $burger->getDescription();