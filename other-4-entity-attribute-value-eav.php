<?php
echo "<h1>Entity-Attribute-Value EAV</h1>";

class Attribute
{
    private $name;
    private $values;
    
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->values = new SplObjectStorage();
    }

    public function addValue(Value $value)
    {
        $this->values->attach($value);
    }

   public function getValues(): SplObjectStorage
   {
       return $this->values;
   } 
    
    public function __toString()
    {
        return $this->name;
    }
}

class Value
{
    private $attribute;
    private $name;

    public function __construct(Attribute $attribute, string $name)
    {
        $this->attribute = $attribute;
        $this->name = $name;

        $attribute->addValue($this);
    }

    public function __toString()
    {
        return sprintf('%s: %s', $this->attribute, $this->name);
    }
}

class Entity
{
    private $name;
    private $values;

    public function __construct(string $name, $values)
    {
        $this->name = $name;
        $this->values = new SplObjectStorage();

        foreach ($values as $key => $value) {
            $this->values->attach($value);
        }
    }

    public function __toString()
    {
        $text = [$this->name];

        foreach ($this->values as $value) {
            $text[] = (string) $value;
        }

        return join(', ', $text);
    }
}

$color  = new Attribute('color');
$black  = new Value($color, 'black');
$white  = new Value($color, 'white');

$memory = new Attribute('memory');
$gb8    = new Value($memory, '8 GB');
$gb16   = new Value($memory, '16 GB');

$macbookPro = new Entity('Macbook Pro', [$black, $gb8]);

echo $macbookPro;