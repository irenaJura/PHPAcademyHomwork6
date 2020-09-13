<?php

class User
{
    private $username;
    private $age;

    public function __construct($username = 'Ivan', $age = 21) {
            $this->username = $username;
            $this->age = $age;
    }

    public function __get($propertyName){
       return $this->$propertyName;
    }
    public function __set($propertyName, $propertyValue){
        property_exists($this, $propertyName) ? $this->$propertyName = $propertyValue : null;
    }
}

// properties can be changed
$d = new User('Irena', 30);
$d->username = 'Jelena';
$d->age = 23;
var_dump($d);

// object can be instantiated without properties
// gets default username and age from __construct
$p = new User();
$p->username = 'John';
$p->age = 34;

var_dump($p);
