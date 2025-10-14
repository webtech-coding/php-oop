<?php

include 'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
use Core\Config;
use Database\Connection;

//instantitate the configuration
Config::load();

//intantiate the database
$database = new Connection();