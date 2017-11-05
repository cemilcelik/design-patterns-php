<?php
echo "<h1>Flyweight</h1>";

class KarakTea
{

}

class TeaMaker
{
    private $availableTea = [];

    public function make(string $preference): KarakTea
    {
        if (empty($this->availableTea[ $preference ])) {
            $this->availableTea[ $preference ] = new KarakTea();
        }

        return $this->availableTea[ $preference ];
    }
}

class TeaShop
{
    private $orders = [];
    private $teaMaker;

    public function __construct(TeaMaker $teaMaker)
    {
        $this->teaMaker = $teaMaker;
    }

    public function takeOrder(string $teaType, int $table)
    {
        $this->orders[ $table ] = $this->teaMaker->make($teaType);
    }

    public function serve()
    {
        foreach ($this->orders as $table => $tea) {
            echo "Serving tea to table #" . $table . "<br>";
        }
    }
}

$teaMaker = new TeaMaker();
$teaShop = new TeaShop($teaMaker);

$teaShop->takeOrder('less-sugar', 1);
$teaShop->takeOrder('more-milk', 2);
$teaShop->takeOrder('without-sugar', 5);

$teaShop->serve();
