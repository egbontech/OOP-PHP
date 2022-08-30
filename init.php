<?php

spl_autoload_register(function($classname){

    include "classes/" . $classname . ".class.php";

});

define("DBHOST","localhost");
define("DBUSER","root");
define("DBPASS","");
define("DBNAME","oop");