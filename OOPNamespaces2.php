<?php
namespace Html;
class Table {
  public $title = "";
  public $numRows = 0;
  public function message() {
    echo "<p>Table '{$this->title}' has {$this->numRows} rows.</p>";
  }
}
$table = new Table();
$table->title = "My table";
$table->numRows = 5;

// To give a namespace an alias
use Html as H;
$table = new H\Table();

// To give a class an alias
use Html\Table as T;
$table = new T();

?>

<!DOCTYPE html>
<html>
<body>

<?php
$table->message();
?>

</body>
</html>