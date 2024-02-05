<?php

trait GreetingTrait {
    public function sayHello() {
        echo "Hello from trait!\n";
    }
}

class MyClass {
    use GreetingTrait;

    public function myMethod() {
        echo "This is my method.\n";
    }
}

$myObject = new MyClass();
$myObject->sayHello();
$myObject->myMethod();

?>