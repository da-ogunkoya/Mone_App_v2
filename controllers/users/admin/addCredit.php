<?php 
require_once('../config/init.php');
$template=new Template('templates/addCredit.php');
$user=new User;
$transaction=new Transaction;
$validator=new Validator;

$id=(isset($_GET['Id']))?$_GET['Id']:"";


$template->receipt=$transaction->findReceiptsByAgent($id);

//find Agent Name
$template->agent=$user->agent_single($id);

//value sent for post
		$postValue="id=".$id." &type=".$_GET['type'];

//table
$table= isset($_GET['type'])?(($_GET['type']=='a')?'agent':'new_customer'):"";
		

		
//POST check
	if(isset($_POST['submit'])){
			$amount=(($_POST['amount']));
			$password=md5(trim($_POST['password']));
			$required=array('password','amount');
						
//Validate Empty Entry	
			if($validator->isRequired($required)){
											
											
//Validate Password																
					$user_id=getUser()['user_id'];								
				if($user->checkPass($password,$user_id)){
					
//Update Add credit																				
					if($user->addCredit($id,$table,$amount)){
									
						redirectValue('memberPage.php','Successfully Updated','success',$postValue);
					}											
				}
				
				else{
					redirectValue('addCredit.php','Password is not Valid','error',$postValue);
				}
			}
			else{
				
				redirectValue('addCredit.php','Missing Parameters','error',$postValue);
			}
			
		}
		echo $template;



?>