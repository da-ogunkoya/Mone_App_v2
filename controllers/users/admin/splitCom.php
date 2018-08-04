<?php 
require_once('../config/init.php');
$template=new Template('templates/splitCom.php');
$user=new User;
$transaction=new Transaction;
$validator=new Validator;

$id=(isset($_GET['Id']))?$_GET['Id']:"";

//findReceipts pay commission

$template->receipt=$transaction->findReceiptsByAgent($id);

//find Agent Name
$template->agent=$user->agent_single($id);

//value sent for post
	$postValue="id=".$id." &type=".$_GET['type'];
		
//POST check
	if(isset($_POST['submit'])){
			$value=(($_POST['agent']));
			$password=md5(trim($_POST['password']));
			$required=array('password','agent');
			
//Validate Empty Entry	
			if($validator->isRequired($required)){
											
											
//Validate Password																
					$user_id=getUser()['user_id'];								
				if($user->checkPass($password,$user_id)){
					
//Update Com commission Split																				
					if($user->updateSplit($id,$value)){
									
						redirectValue('memberPage.php','Successfully Updated','success',$postValue);
					}											
				}
				
				else{
					redirectValue('splitCom.php','Password is not Valid','error',$postValue);
				}
			}
			else{
				
				redirectValue('splitCom.php','Missing Parameters','error',$postValue);
			}
			
		}
		echo $template;



?>