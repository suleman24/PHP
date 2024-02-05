<?php

class Person {
    private $name;
    private $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getAge() {
        return $this->age;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function displayInfo() {
        echo "Name: {$this->name}, Age: {$this->age}\n";
    }
}

$person1 = new Person("Suleman", 21);

$person1->displayInfo();

$person1->setName("Suleman");

$person1->setAge(30);

$person1->displayInfo();

?>
