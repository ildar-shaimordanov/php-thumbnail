<?php

if (!defined('PATH_SEPARATOR')) {
    define('PATH_SEPARATOR', (preg_match('/WIN/i', PHP_OS)) ? ';' : ':');
}

ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . dirname(dirname(__FILE__)));

?>