<?php 
require_once('../config/init.php');

$user=new User;
//agent
$template_a=new Template('templates/members_a.php');

//customer
$template_c=new Template('templates/members_c.php');

//search 
		if( isset($_GET['agentUser']) || isset($_GET['custUser'])){
				if(isset($_GET['agentUser'])){
					$searchUser = $_GET['agentUser'];
					$id =substr($searchUser, strpos( $searchUser, "-") + 1);
					$_GET['type']='a';
				}
				else{
					$searchUser = $_GET['custUser'];
					$id =substr($searchUser, strpos( $searchUser, "-") + 1);
					$_GET['type']='c';
				}
			
		}
		
	
		else{
			$id="";
		}
		
//find user type
$type=isset($_GET['type'])?$_GET['type']:"";

//agent
	
	if($type=='a'){
		$template_a->type=$type;
		$template_a->dataResult=$user->agent($id);
			echo $template_a;
	}
//customer
	else{
		$template_c->type=$type;
		$template_c->dataResult=$user->customer($id);
			echo $template_c;
	}

?>