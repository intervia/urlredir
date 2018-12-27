<?php

/**
 * 
 * @name Redirection test
 * @version 1.0.1 (2018-11-14)
 * @author Juan cimadevilla
 * @license MIT
 * @copyright Intervia IT (intervia.com)
 * 
 */

/*
 * 
 * Benchmark results:
 * - Array file: 4.2MB (40052 redirections)
 * - Elapsed time: 3ms
 * - Memory used: 2MB
 * 
 * Dedicated server:
 * - Xeon E5-1620 3.5GHz
 * - SSD 527MB/s
 * - PHP 7.1 FPM
 * 
 */

//Init microtime and memory
$memory = memory_get_usage();
$microtime = microtime(true);

//Load class
include "class_urlredir.php";

//Init class
$urlredir = new urlredir;

//Load redirections from json file
//if json file does not exist, create it from the array on file
if (is_file("redirections.json")) {
    $redir = json_decode(file_get_contents("redirections.json"),true);
    
} else {
    
    if (is_file("redirections.php")) {
        
        //Note: includes of very large files can produce 503 errors
        include "redirections.php";
        file_put_contents('redirections.json', json_encode($redir));
    }
}

//Count the number of redirections
$reg = count($redir);

//Make redirection if any match
$urlredir->redirect($redir,'307');

//Calc time and memory used
$time = round((microtime(true) - $microtime)*1000);
$mem = round((memory_get_usage() - $memory) / 1024);

echo "Verified $reg redirections in $time ms<br>";
echo "Consumed memory: $mem KB<br>";

//Remove redirections array from memory
$redir = null;

//Recalc memory used without the redirections
$mem = round((memory_get_usage() - $memory) / 1024);
echo "Memory used by script and redir class: $mem KB";