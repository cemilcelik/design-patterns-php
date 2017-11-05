<?php
echo "<h1>Chain Of Responsibility</h1>";

abstract class Account
{
    protected $succesor;
    protected $balance;

    public function setNext(Account $account)
    {
        $this->succesor = $account;
    }

    public function pay(float $amount)
    {
        if ($this->canPay($amount)) {
            echo sprintf('Paid %s using %s' . PHP_EOL, $amount, get_called_class());
            echo "<br>";
        }elseif ($this->succesor) {
            echo sprintf('Cannot pay using %s. Proceeding ..' . PHP_EOL, get_called_class());
            echo "<br>";
            $this->succesor->pay($amount);
        }else{
            echo('None of the accounts have enough balance.'); 
            echo "<br>";
        }
    }

    public function canPay(float $amount): bool
    {
        return $this->balance >= $amount;
    }
}

class Bank extends Account
{
    protected $balance;

    public function __construct(float $balance)
    {
        $this->balance = $balance;
    }
}

class Paypal extends Account
{
    protected $balance;

    public function __construct(float $balance)
    {
        $this->balance = $balance;
    }
}

class Bitcoin extends Account
{
    protected $balance;

    public function __construct(float $balance)
    {
        $this->balance = $balance;
    }
}

$bank = new Bank(200);
$paypal = new Paypal(300);
$bitcoin = new Bitcoin(400);

$bank->setNext($paypal);
$paypal->setNext($bitcoin);

$bank->pay(350);
