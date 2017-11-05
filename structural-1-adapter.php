<?php
echo "<h1>Adapter</h1>";

interface Lion
{
    public function roar();
    public function printName();
}

class AfricanLion implements Lion
{
    public function roar() {
        echo 'Roarrr!';
    }
    public function printName() {
        return 'African lion';
    }
}

class AsianLion implements Lion
{
    public function roar() {
        echo 'Roarrr!';
    }
    public function printName() {
        return 'Asian lion';
    }
}

class WildDog
{
    public function bark()
    {
        echo 'Hev hev!';
    }
}

class WildDogAdapter implements Lion
{
    private $dog;

    public function __construct(WildDog $dog)
    {
        $this->dog = $dog;
    }

    public function roar()
    {
        $this->dog->bark();
    }

    public function printName() {
        return 'Wild dog';
    }
}

class Hunter
{
    public function hunt(Lion $lion)
    {
        $lion->roar();
        echo "<br>";
        echo $lion->printName() . ' hunted.';
    }
}

$asianLion = new AsianLion();
$hunter = new Hunter();
$hunter->hunt($asianLion);

echo "<br>";

$wildDog = new WildDog();
$wildDogAdapter = new WildDogAdapter($wildDog);
$hunter = new Hunter();
$hunter->hunt($wildDogAdapter);
