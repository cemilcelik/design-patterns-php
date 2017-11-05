<?php
echo "<h1>Bridge</h1>";

interface Thema
{
    public function getColor();
}

class DarkThema implements Thema
{
    public function getColor()
    {
        return 'Dark Black';
    }
}

class LightThema implements Thema
{
    public function getColor()
    {
        return 'Off White';
    }
}

interface Page
{
    public function __construct(Thema $thema);
    public function getContent();
}

class About implements Page
{
    private $thema;

    public function __construct(Thema $thema)
    {
        $this->thema = $thema;
    }

    public function getContent()
    {
        return 'About Page in ' . $this->thema->getColor();
    }
}

class Careers implements Page
{
    private $thema;

    public function __construct(Thema $thema)
    {
        $this->thema = $thema;
    }

    public function getContent()
    {
        return 'Careers page in ' . $this->thema->getColor();
    }
}

$darkThema = new DarkThema();
$about = new About($darkThema);
echo $about->getContent(); // About page in Dark Black

echo "<br>";

$lightThema = new LightThema();
$careers = new Careers($lightThema);
echo $careers->getContent(); // Careers page in Dark Black
