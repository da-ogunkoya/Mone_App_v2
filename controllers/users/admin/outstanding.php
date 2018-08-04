<?php 
require_once('../config/init.php');

$user=new User;
$template=new Template('templates/outstanding.php');
$id="";
//set table based on business size or switch btw agent-customer
	$type=isset($_GET['type'])?$_GET['type']:pTable()['type'];

$template->Ttype=$type;
//agent
	if($type=='a' || $type=='ac'){
	$template->dataResult=$user->agent($id);
	}
	else{
		$template->dataResult=$user->customer($id);
	}
echo $template;
?>