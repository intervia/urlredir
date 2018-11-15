<?php

/**
 * 
 * @name Redirection test
 * @version 1.0.0 (2018-11-14)
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

//Init array
$redir = [];
include "redirections.php";

//Read number or redirections
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