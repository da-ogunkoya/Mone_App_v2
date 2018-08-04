<?php
session_start();
require_once ('../controllers/users/config/constant.php');
require_once 'addon.php';

	//Helper Function Files
	require_once('../controllers/users/helpers/system_helper.php');
	require_once('../controllers/users/helpers/format_helper.php');
	require_once('../controllers/users/helpers/db_helper.php');
//initialise all model classes
function __autoload($classname){
	require_once('models/'.$classname.'.php');
}


?>
