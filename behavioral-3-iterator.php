<?php
namespace DesignPatterns;

echo "<h1>Iterator</h1>";

use Countable;
use Iterator;

class StationList implements Countable, Iterator
{
    /** @var RadioStation[] $stations */
    protected $stations = [];

    /** @var int $counter */
    protected $counter;

    public function addStation(RadioStation $radioStation)
    {
        $this->stations[] = $radioStation;
    }

    public function removeStation(RadioStation $radioStation)
    {
        $toRemoveFrequency = $radioStation->getFrequency();
        $this->stations = array_filter($this->stations, function (RadioStation $station) use ($toRemoveFrequency) {
            return $station->getFrequency() !== $toRemoveFrequency;
        });
    }

    public function count(): int
    {
        return count($this->stations);
    }

    public function current(): RadioStation
    {
        return $this->stations[ $this->counter ];
    }

    public function key()
    {
        return $this->counter;
    }

    public function next()
    {
        $this->counter++;
    }

    public function rewind()
    {
        $this->counter = 0;
    }

    public function valid(): bool
    {
        return isset($this->stations[ $this->counter ]);
    }

    public function __toString()
    {
        $string = '';
        foreach ($this->stations as $station) {
            $string .= $station->getFrequency() . "<br>";
        }
        return $string;
    }
}

class RadioStation
{
    private $frequency;

    public function __construct(float $frequency)
    {
        $this->frequency = $frequency;
    }

    public function getFrequency(): float
    {
        return $this->frequency;
    }
}

$stationList = new StationList();

$stationList->addStation(new RadioStation(89));
$stationList->addStation(new RadioStation(101));
$stationList->addStation(new RadioStation(102));
$stationList->addStation(new RadioStation(103.2));

foreach ($stationList as $station) {
    echo $station->getFrequency() . "<br>";
}

$stationList->removeStation(new RadioStation(89));

echo "<br>";
echo $stationList;
