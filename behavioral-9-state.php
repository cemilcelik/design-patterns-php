<?php
echo "<h1>State</h1>";

interface WritingState
{
    public function write(string $words);
}

class DefaultCase implements WritingState
{
    public function write(string $words)
    {
        echo $words;
        echo "<br>";
    }
}

class UpperCase implements WritingState
{
    public function write(string $words)
    {
        echo strtoupper($words);
        echo "<br>";
    }
}

class LowerCase implements WritingState
{
    public function write(string $words)
    {
        echo strtolower($words);
        echo "<br>";
    }
}

class TextEditor
{
    private $state;

    public function __construct(WritingState $state)
    {
        $this->state = $state;
    }

    public function setState(WritingState $state)
    {
        $this->state = $state;
    }

    public function type(string $words)
    {
        $this->state->write($words);
    }
}

$textEditor = new TextEditor(new DefaultCase());

$textEditor->type('First line');

$textEditor->setState(new UpperCase());

$textEditor->type('Second line');
$textEditor->type('Third line');

$textEditor->setState(new LowerCase());

$textEditor->type('Fourth line');
$textEditor->type('Fifth line');
