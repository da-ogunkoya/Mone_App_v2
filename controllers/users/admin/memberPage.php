<?php
require_once('../config/init.php');
$template=new Template('templates/memberPage.php');

//set type
//set table 
$type=isset($_GET['type'])?$_GET['type']:pTable()['type'];	
$template->type=$type;


$user=new User;
	$id=isset($_GET['id'])?$_GET['id']: " ";
	
//Display agent / customer
	switch($type){	
		case 'a':
		$template->dataResult=$user->agent($id);
		break;
		
		case 'ac':
		$template->dataResult=$user->agent($id);
		break;
		
		case 'c':
		$template->dataResult=$user->customer($id);
		break;
}
echo $template;
?>