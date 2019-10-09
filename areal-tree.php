#!/usr/bin/php
<?php
function outputTree ($dir, $iterator, $search_file) {
  $iterator .= "   ";
  $handle = opendir($dir);
  while (($file = readdir($handle)) !== false) {

    if ($file == '.' || $file == '..') {
      continue;
    }
    else {
      if (is_file($dir.DIRECTORY_SEPARATOR.$file) && $search_file) {
        echo $iterator."└──".$file."(".filesize($dir.DIRECTORY_SEPARATOR.$file).")\n";
      }
      if (is_dir(($dir.DIRECTORY_SEPARATOR.$file))) {
        echo $iterator."└──".$file."\n";
        outputTree($dir.DIRECTORY_SEPARATOR.$file, $iterator, $search_file);
      }
    }

  }
  closedir($handle);
}

if (isset($argv[1])) {
  chdir($argv[1]);
  $dir = getcwd();
  $iterator = "|";

  if(empty($argv[2])) {
    outputTree($dir, $iterator, false);
  }
  elseif ($argv[2] === "-f") {
    outputTree($dir, $iterator, true);
  }
  else {
    echo "Error: undefined argument '".$argv[2]."'\n";
  }
}
else {
  echo "Error: please pass the directory in first argument \n";
}
?>
