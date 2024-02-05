class MyClass {
    const con = 'Hello, World!';

    public function fun() {
        return self::con;
    }
}

echo MyClass::con;

$a = new MyClass();
echo $a->fun();
