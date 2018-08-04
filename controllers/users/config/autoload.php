<?php
/*
| --------------------
  Helper Function Files
| ----------------------

 */
require_once('constant.php');
require_once('helpers/system_helper.php');
require_once('helpers/format_helper.php');
require_once('helpers/db_helper.php');

/*
| --------------------
  Autoload classes here
| ----------------------

 */
function __autoload($class_name){
	require_once('libraries/'.$class_name . '.php');

}


?>
