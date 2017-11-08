<?php
echo "<h1>Template Method</h1>";

abstract class Builder
{
    // Template method
    final public function build() {
        $this->test();
        $this->lint();
        $this->assemble();
        $this->deploy();
    }

    abstract public function test();
    abstract public function lint();
    abstract public function assemble();
    abstract public function deploy();
}

class AndroidBuilder extends Builder
{
    public function test()
    {
        echo 'Running android tests.';
        echo "<br>";
    }
    
    public function lint()
    {
        echo 'Linting the andriod code.';
        echo "<br>";
    }
    
    public function assemble()
    {
        echo 'Assembling the android build.';
        echo "<br>";
    }
    
    public function deploy()
    {
        echo 'Deploying android build to server.';
        echo "<br>";
    }
}

class IosBuilder extends Builder
{
    public function test()
    {
        echo 'Running ios tests.';
        echo "<br>";
    }
    
    public function lint()
    {
        echo 'Linting the ios code.';
        echo "<br>";
    }
    
    public function assemble()
    {
        echo 'Assembling the ios build.';
        echo "<br>";
    }
    
    public function deploy()
    {
        echo 'Deploying ios build to server.';
        echo "<br>";
    }
}

$androidBuilder = new AndroidBuilder();
$androidBuilder->build();

echo "<br>";

$iosBuilder = new IosBuilder();
$iosBuilder->build();