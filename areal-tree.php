#!/usr/bin/php
<?php

function outputTree ($item) {
  if(is_dir($item)){

    $trees = glob( $item . '*', GLOB_MARK );
    foreach ($trees as $tree) {
      print "|".$item."\n";
      outputTree($tree);
      print "-";
    }

  }
}

if (isset($argv[1])) {
  chdir($argv[1]);
  $dir = getcwd();
  if (isset($argv[2]) && $argv[2] === "-f") {
    outputTree($dir);
  }
  elseif (empty($argv[2])) {
    $tree = scandir($dir);
  }
  else {
    echo "Error: undefined argument '".$argv[2]."'\n";
  }
}
else {
  echo "Error: please pass the directory in first argument \n";
}
?>
