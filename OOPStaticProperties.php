<?php

class Counter {
    public static $count = 0;

    public function __construct() {
        self::$count++;
    }

    public static function getCount() {
        return self::$count;
    }
}

$counter1 = new Counter();
$counter2 = new Counter();

echo "Count: " . Counter::getCount() . "\n";

echo "Static property directly: " . Counter::$count . "\n";

?>