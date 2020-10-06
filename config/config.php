<?php 
//session_start();

function __autoload($class) {
    include "classes/" . $class . ".class.php";
}
/* DB-settings  */
define("DBHOST", "localhost");
define("DBUSER", "coursedb");
define("DBPASS", "coursedbpass");
define("DBDATABASE", "coursedb"); 