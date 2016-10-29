<?php
function __autoload($class){
	$filename="library/{$class}.php";
	if(file_exists($filename)){
		include_once $filename;
	}
}



$db = array(
	'host' => 'localhost',
	'user' => 'Marina',
	'pass' => '6Xv7chMl2F8YldPu',
	'name' => 'foto',
);

$template = './template/showcatalog.php';