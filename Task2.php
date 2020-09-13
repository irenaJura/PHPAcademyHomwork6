<?php

// class for reference
class Qux
{
    public function __call($name, $arguments)
    {
        $args = implode(', ', $arguments);
        echo static::class . '::' . __FUNCTION__ . "(name: {$name}, arguments: [{$args}])" . '<br>';
    }
}

$qux = new Qux();
$qux->setName('Pero', 'Perić', 'Deric'); // calls __call()

class DataObject
{
    private $data = [];

    private function setData($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function getData($key)
    {
        return $this->data[$key] ?? null; // ?? => null coalescing operator
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            $this->$name(...$arguments); // ... => splat operator
        }
    }

    private static function printArguments(...$arguments)
    {
        echo implode(', ', $arguments) . '<br>';
    }

    public static function __callStatic($name, $arguments)
    {
        if (method_exists(static::class, $name)) {
            static::$name(...$arguments); // ... => splat operator
        }
    }
}

$dataObject = new DataObject();

$dataObject->setData('name', 'Pero'); // calls __call()
echo $dataObject->getData('name'); // calls getData()

DataObject::printArguments(1, 2, 3, 4, 5); // calls __callStatic()
