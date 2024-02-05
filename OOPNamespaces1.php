<?php

namespace MyNamespace;

class MyClass {
    public function sayHello() {
        echo "Hello from MyClass in MyNamespace!\n";
    }
}

$obj = new MyClass();
$obj->sayHello();

$nobj = new \MyNamespace\MyClass();
$nobj->sayHello();

use MyNamespace\MyClass as AnotherClass;

$aobj = new AnotherClass();
$aobj->sayHello();

?>