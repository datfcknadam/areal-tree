<?php
  require_once "areal-tree.php";

  try {
    if (empty($argv[1])) {
      throw new Exception("Error: please pass the directory in first argument. \n");
    }
    if (!is_dir($argv[1])) {
      throw new Exception("Error: such directory not found.\n");
    }
    if(isset($argv[2])) {
      $tree = new Tree($argv[1], $argv[2]);
    }
    else {
      $tree = new Tree($argv[1], null);
    }
    echo $tree->output();
  }
  catch(Exception $e) {
    echo $e->getMessage();
  }
?>
