<?php
echo "<h1>Factory Method</h1>";

interface Interviewer
{
    public function askQuestion();
}

class Developer implements Interviewer
{
    public function askQuestion()
    {
        echo "Asking about design patterns!";
    }
}

class Marketer implements Interviewer
{
    public function askQuestion()
    {
        echo "Asking about community building!";
    }
}

abstract class HiringManager
{
    // factory method
    abstract function makeInterviewer(): Interviewer;

    function takeInterview()
    {
        $interviwer = $this->makeInterviewer();
        $interviwer->askQuestion();
    }
}

class DevelopementManager extends HiringManager
{
    public function makeInterviewer(): Interviewer
    {
        return new Developer;
    }
}

class MarketingManager extends HiringManager
{
    public function makeInterviewer(): Interviewer
    {
        return new Marketer;
    }
}

$devManager = new DevelopementManager();
$devManager->takeInterview(); // Output: Asking about design patterns
echo "<br>";

$marManager = new MarketingManager();
$marManager->takeInterview(); // Output: Asking about community building
echo "<br>";
