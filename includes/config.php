<?php
ob_start();
session_start();

//DATABASE CONFIG
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','toyota');
define('DBNAME','radeon');


//DO NOT MODIFY BELOW
$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
function __autoload($class) { 
   $class = strtolower($class);
   $classpath = 'classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	} 	
   $classpath = '../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	}
   $classpath = '../../classes/class.'.$class . '.php';
   if ( file_exists($classpath)) {
      require_once $classpath;
	} 		
}

$user = new User($db); 
include 'general_settings.php'; 

?>