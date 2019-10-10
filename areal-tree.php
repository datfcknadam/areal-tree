<?php
class Tree {
  public $is_dir;
  public $is_arg;

  function filesize_formatted($path) {
    $size = filesize($path);
    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $power = $size > 0 ? floor(log($size, 1024)) : 0;

    return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
  }

  public function __construct($is_dir, $is_arg) {
      $this->is_dir = $is_dir;
      $this->is_arg = $is_arg;
  }

  function outputTree ($dir, $iterator, $search_file) {
    $iterator .= "   ";
    $handle = opendir($dir);

    while (($file = readdir($handle)) !== false) {

      if ($file == '.' || $file == '..') {
        continue;
      }
      if (is_file($dir.DIRECTORY_SEPARATOR.$file) && $search_file) {
        echo $iterator."└──".$file."(".$this->filesize_formatted($dir.DIRECTORY_SEPARATOR.$file).")\n";
      }
      if (is_dir($dir.DIRECTORY_SEPARATOR.$file)) {
        echo $iterator."└──".$file."\n";
        $this->outputTree($dir.DIRECTORY_SEPARATOR.$file, $iterator, $search_file);
      }
    }
    closedir($handle);
  }

  public function output() {

    try {
      if ($this->is_arg && $this->is_arg !== "-f") {
        throw new Exception("Error: undefined argument '".$this->is_arg."'\n");
      }
      chdir($this->is_dir);
      $dir = getcwd();
      $iterator = "";
      $this->outputTree($dir, $iterator, $this->is_arg);

    }
    catch (Exception $e) {
      echo $e->getMessage();
    }
  }
}
?>
