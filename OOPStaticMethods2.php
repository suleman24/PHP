<?php
class A {
  public static function welcome() {
    echo "Hello World!";
  }
}

class B {
  public function message() {
    A::welcome();
  }
}

$obj = new B();
echo $obj -> message();




class domain {
    protected static function web() {
      return "google.com";
    }
  }
  
  class domainG extends domain {
    public $wname;
    public function __construct() {
      $this->wname = parent::web();
    }
  }
  
  $domainW3 = new domainG;
  echo $domainW3 -> wname;
?>