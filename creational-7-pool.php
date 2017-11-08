<?php
namespace DesignPatterns;

echo "<h1>Pool</h1>";

class Pool implements \Countable
{
    private $occupiedWorkers = [];
    private $freeWorkers = [];

    public function count()
    {
        return count($this->occupiedWorkers) + count($this->freeWorkers);
    }

    public function get(): StringReverseWorker
    {
        if (count($this->freeWorkers) == 0) {
            $worker = new StringReverseWorker();
        }else{
            $worker = array_pop($this->freeWorkers);
        }

        $this->occupiedWorkers[ spl_object_hash($worker) ] = $worker;

        return $worker;
    }

    public function dispose(StringReverseWorker $worker)
    {
        $splObjectHash = spl_object_hash($worker);

        if (array_key_exists($splObjectHash, $this->occupiedWorkers)) {
            unset($this->occupiedWorkers[ $splObjectHash ]);
            $this->freeWorkers[ $splObjectHash ] = $worker;
        }
    }
}

class StringReverseWorker
{
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function run(string $text)
    {
        echo strrev($text);
    }
}

$pool = new Pool();

$worker1 = $pool->get();
echo "Worker 1 created";
echo "<br>";

$worker2 = $pool->get();
echo "Worker 2 created";
echo "<br>";

echo "Worker 1 == Worker 2 : " . (($worker1 === $worker2) ? 'True' : 'False');
echo "<br>";

$pool->dispose($worker2);
echo "Worker 2 disposed";
echo "<br>";

$worker3 = $pool->get();
echo "Worker 3 created (actually old Worker 2)";
echo "<br>";

echo "Worker 3 == Worker 2 : " . (($worker2 === $worker3) ? 'True' : 'False');
echo "<br>";
