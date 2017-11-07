<?php
echo "<h1>Visitor</h1>";

// visitee
interface Animal
{
    public function accept(AnimalOperation $operation);
}

// visitor
interface AnimalOperation
{
    public function visitMonkey(Monkey $monkey);
    public function visitLion(Lion $lion);
    public function visitDolphin(Dolphin $dolphin);
}

class Monkey implements Animal
{
    public function shout()
    {
        echo 'Ooh oo aa aa!';
        echo "<br>";
    }

    public function accept(AnimalOperation $operation)
    {
        $operation->visitMonkey($this);
    }
}

class Lion implements Animal
{
    public function shout()
    {
        echo 'Roaaar!';
        echo "<br>";
    }

    public function accept(AnimalOperation $operation)
    {
        $operation->visitLion($this);
    }
}

class Dolphin implements Animal
{
    public function shout()
    {
        echo 'Tuut tutt tuutt!';
        echo "<br>";
    }

    public function accept(AnimalOperation $operation)
    {
        $operation->visitDolphin($this);
    }
}

class Speak implements AnimalOperation
{
    public function visitMonkey(Monkey $monkey)
    {
        $monkey->shout();
    }

    public function visitLion(Lion $lion)
    {
        $lion->shout();
    }

    public function visitDolphin(Dolphin $dolphin)
    {
        $dolphin->shout();
    }
}

class Jump implements AnimalOperation
{
    public function visitMonkey(Monkey $monkey)
    {
        echo 'Jumped 20 feet high! on to the tree!';
        echo "<br>";
    }
    
    public function visitLion(Lion $lion)
    {
        echo 'Jumped 7 feet! Back on the ground!';
        echo "<br>";
    }
    
    public function visitDolphin(Dolphin $dolphin)
    {
        echo 'Walked on water a little and disappeared!';
        echo "<br>";
    }
}

$monkey = new Monkey();
$lion = new Lion();
$dolphin = new Dolphin();

$speak = new Speak();

$monkey->accept($speak); // Ooh oo aa aa!
$lion->accept($speak); // Roaaar!
$dolphin->accept($speak); // Tuut tutt tuutt!

$jump = new Jump();

$monkey->accept($jump); // Jumped 20 feet high! on to the tree!
$lion->accept($jump); // Jumped 7 feet! Back on the ground!
$dolphin->accept($jump); // Walked on water a little and disappeared!
