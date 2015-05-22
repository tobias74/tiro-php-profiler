<?php

error_reporting(E_ALL);
date_default_timezone_set('Europe/Berlin');

spl_autoload_register(function ($class) {
    $prefix = 'Tiro\\';
    $base_dir = __DIR__ . '/../../src/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});


echo "Starting...";


$profiler = new \Tiro\Profiler();


$timer = $profiler->startTimer('outside the loop 1 - 1000');

for ($i=0;$i<1000;$i++){
  $dummy = sqrt($i);
}

$timer->stop();



for ($i=0;$i<1000;$i++){
  $timer = $profiler->startTimer('inside the loop 1 to 1000');
  $dummy = md5($i);
  $timer->stop();
}


  
echo "<pre>";  
print_r($profiler->getHash());
echo "</pre>";  
