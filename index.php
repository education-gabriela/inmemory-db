<?php
require "vendor/autoload.php";
use Gabidavila\DB\Storage;
use Gabidavila\DB\MemoryDB;

$execute = true;
$storage = new Storage();
$db = new MemoryDB($storage);

while ($execute) {
  try {
    $execute = $db->exec();
  } catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }
}
