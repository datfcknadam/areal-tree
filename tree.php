<?php
class Tree {
  private $end = true;
  public $trees_only_dir = [];

  function filesize_formatted($path) {
    $size = filesize($path);
    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $power = $size > 0 ? floor(log($size, 1024)) : 0;
    return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
  }

  function outputTree ($dir, $iterator, $search_file) {

    if (!$this->end) {
    $iterator .= "│   ";
    }
    else{
      $iterator .= "    ";
    }

    $trees = array_diff(scandir($dir), array('..', '.'));

    if (!$search_file) {
      foreach ($trees as $key => $file) {

        if (is_dir($file)) {
          array_push($this->trees_only_dir, $file);
          $trees = $this->trees_only_dir;
        }
      }
      $this->trees_only_dir = [];
    }

    foreach($trees as $key => $file) {
      if($file == end($trees)){
        $this->end = true;

        if (is_file($dir.DIRECTORY_SEPARATOR.$file) && $search_file) {
          echo $iterator."└── ".$file."(".$this->filesize_formatted($dir.DIRECTORY_SEPARATOR.$file).")\n";
        }

        if (is_dir($dir.DIRECTORY_SEPARATOR.$file)) {
          echo $iterator."└── ".$file."\n";
          $this->outputTree($dir.DIRECTORY_SEPARATOR.$file, $iterator, $search_file);
        }
        continue;
      }

      $this->end = false;

      if (is_file($dir.DIRECTORY_SEPARATOR.$file) && $search_file) {
        echo $iterator."├── ".$file."(".$this->filesize_formatted($dir.DIRECTORY_SEPARATOR.$file).")\n";
      }
      if (is_dir($dir.DIRECTORY_SEPARATOR.$file)) {
        echo $iterator."├── ".$file."\n";
        $this->outputTree($dir.DIRECTORY_SEPARATOR.$file, $iterator, $search_file);
      }
    }
  }

  public function output($dir, $arg) {
    try {
      if ($arg && $arg !== "-f") {
        throw new Exception("Error: undefined argument '".$arg."'\n");
      }
      chdir($dir);
      $dir = getcwd();
      $iterator = "";
      $this->outputTree($dir, $iterator, $arg);
    }
    catch (Exception $e) {
      echo $e->getMessage();
    }
  }

}
?>

