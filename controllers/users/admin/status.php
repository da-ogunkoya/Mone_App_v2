<?php 
require_once('../config/init.php');
$template=new Template('templates/status.php');
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
			$choice=(($_POST['choice']));
			$password=md5(trim($_POST['password']));
			$required=array('password','choice');
			
			switch($choice){
				case "ACTIVE":
				$choice=1;
				break;
				
				case "SUSPENDED":
				$choice=0;
				break;
				
				case "Admin Level 2":
				$choice=3;
				break;
				
				case "LIMIT":
				$choice=-1;
				break;
			}
			
//Validate Empty Entry	
			if($validator->isRequired($required)){
											
											
//Validate Password																
					$user_id=getUser()['user_id'];								
				if($user->checkPass($password,$user_id)){
					
//Update Com commission Split																				
					if($user->updateStatus($id,$table,$choice)){
									
						redirectValue('memberPage.php','Successfully Updated','success',$postValue);
					}											
				}
				
				else{
					redirectValue('status.php','Password is not Valid','error',$postValue);
				}
			}
			else{
				
				redirectValue('status.php','Missing Parameters','error',$postValue);
			}
			
		}
		echo $template;



?>