<?php
class Car {
  public $name;
  public $color;

  function __construct($name, $color) {
    $this->name = $name;
    $this->color = $color;
  }
  function get_name() {
    return $this->name;
  }
  function get_color() {
    return $this->color;
  }

  function __destruct() {
    echo "The car is {$this->name} and the color is {$this->color}.";
  }

}

$honda = new Car("Honda","white");
echo "Name: " . $honda->get_name();
echo "<br>";
echo "Color: " . $honda->get_color();
?>