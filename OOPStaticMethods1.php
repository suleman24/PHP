<?php

class MathOperations {
    public static function add($a, $b) {
        return $a + $b;
    }

    public static function subtract($a, $b) {
        return $a - $b;
    }
}

$resultAddition = MathOperations::add(5, 3);
$resultSubtraction = MathOperations::subtract(8, 4);

echo "Addition result: $resultAddition\n";
echo "Subtraction result: $resultSubtraction\n";

?>