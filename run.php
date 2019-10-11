<?php
  require_once "tree.php";
  $tree = new Tree();

  try {
    if (empty($argv[1])) {
      throw new Exception("Error: please pass the directory in first argument. \n");
    }
    if (!is_dir($argv[1])) {
      throw new Exception("Error: such directory not found.\n");
    }
    if (isset($argv[2])) {
      $tree->output($argv[1], $argv[2]);
    }
    else {
      $tree->output($argv[1], null);
    }
  }
  catch (Exception $e) {
    echo $e->getMessage();
  }
?>
