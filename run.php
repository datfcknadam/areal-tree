
<?php 
  require_once "areal-tree.php";
  $tree = new Tree($argv[1], $argv[2]);
  echo $tree->output();
?>