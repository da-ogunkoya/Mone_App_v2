<?php 
require_once('../config/init.php');
$template=new Template('templates/deleteMember.php');
$user=new User;
$transaction=new Transaction;
$validator=new Validator;

$id=(isset($_GET['Id']))?$_GET['Id']:"";


$template->receipt=$transaction->findReceiptsByAgent($id);

//find Agent Name
$template->agent=$user->agent_single($id);

//value sent for post
		$postValue="id=".$id;

//table
$table= pTable()['userTable'];
		

		
//POST check
	if(isset($_POST['submit'])){
			$password=md5(trim($_POST['password']));
			$required=array('password');
				
			
//Validate Empty Entry	
			if($validator->isRequired($required)){
											
											
//Validate Password																
					$user_id=getUser()['user_id'];								
				if($user->checkPass($password,$user_id)){
					
//delete Member																				
					if($user->deleteMembers($id,$table)){
									
						redirectValue('members.php','Successfully Deleted','success',$postValue);
					}											
				}
				
				else{
					redirectValue('deleteMember.php','Password is not Valid','error',$postValue);
				}
			}
			else{
				
				redirectValue('deleteMember.php','Missing Parameters','error',$postValue);
			}
			
		}
		echo $template;



?>