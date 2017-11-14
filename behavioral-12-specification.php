<?php
echo "<h1>Specifications</h1>";

interface Specification
{
    public function isSatisfiedBy(Item $item): bool;
}

class AndSpecification implements Specification
{
    private $specs = [];

    public function __construct(PriceSpecification ...$priceSpec)
    {
        $this->specs = $priceSpec;
    }
    
    public function isSatisfiedBy(Item $item): bool
    {
        foreach ($this->specs as $spec) {
            if ( ! $spec->isSatisfiedBy($item)) {
                return false;
            }
        }

        return true;
    }
}

class OrSpecification implements Specification
{
    private $specs = [];

    public function __construct(PriceSpecification ...$priceSpec)
    {
        $this->specs = $priceSpec;
    }
    
    public function isSatisfiedBy(Item $item): bool
    {
        foreach ($this->specs as $spec) {
            if ($spec->isSatisfiedBy($item)) {
                return true;
            }
        }

        return false;
    }
}

class PriceSpecification implements Specification
{
    private $min;
    private $max;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function isSatisfiedBy(Item $item): bool
    {
        if ( ($item->getPrice() > $this->min) && ($item->getPrice() < $this->max) ) {
            return true;
        }

        return false;
    }
}

class Item
{
    private $price = 0;

    public function __construct(int $price)
    {
        $this->price = $price;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}

$priceSpec1 = new PriceSpecification(100, 150);
$priceSpec2 = new PriceSpecification(100, 250);
$priceSpec3 = new PriceSpecification(100, 350);

$andSpec = new AndSpecification($priceSpec1, $priceSpec2, $priceSpec3);
$orSpec = new OrSpecification($priceSpec1, $priceSpec2, $priceSpec2);

echo 'Spec1=[100, 150] <br> Spec2=[100, 250] <br> Spec3=[100, 350]';
echo "<br>";
echo "<br>";

echo '(Item(99) === andSpec()): ' . (($andSpec->isSatisfiedBy(new Item(99))) ? 'True' : 'False');
echo "<br>";
echo '(Item(101) === andSpec()): ' . (($andSpec->isSatisfiedBy(new Item(101))) ? 'True' : 'False');
echo "<br>";
echo '(Item(151) === andSpec()): ' . (($andSpec->isSatisfiedBy(new Item(151))) ? 'True' : 'False');
echo "<br>";
echo "<br>";

echo '(Item(99) === orSpec()): ' . (($orSpec->isSatisfiedBy(new Item(99))) ? 'True' : 'False');
echo "<br>";
echo '(Item(101) === orSpec()): ' . (($orSpec->isSatisfiedBy(new Item(99))) ? 'True' : 'False');
echo "<br>";
echo '(Item(151) === orSpec()): ' . (($orSpec->isSatisfiedBy(new Item(99))) ? 'True' : 'False');
echo "<br>";
