<?php
echo "<h1>Strategy</h1>";

interface SortStrategy
{
    public function sort($dataSet = []);
}

class BubbleSortStrategy implements SortStrategy
{
    public function sort($dataSet = [])
    {
        echo 'Output: Sorting using bubble sort';
        echo "<br>";
    }
}

class QuickSortStrategy implements SortStrategy
{
    public function sort($dataSet = [])
    {
        echo 'Output: Sorting using quick sort';
        echo "<br>";
    }
}

class Sorter
{
    private $sortStrategy;
    
    public function __construct(SortStrategy $sortStrategy)
    {
        $this->sortStrategy = $sortStrategy;
    }

    public function sort($dataSet = [])
    {
        $this->sortStrategy->sort($dataSet);
    }
}

$dataSet = [1, 5, 4, 3, 2, 8];

$sorter = new Sorter(new BubbleSortStrategy());
$sorter->sort($dataSet);

$sorter = new Sorter(new QuickSortStrategy());
$sorter->sort($dataSet);
