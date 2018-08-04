<?php 
require_once('../config/init.php');
$template=new Template('templates/moveCustomer.php');
$user=new User;
$transaction=new Transaction;
$validator=new Validator;

$id=(isset($_GET['id']))?$_GET['id']:"";
$template->customer=isset($id)?$user->findTheMember($id,'new_customer'):"";
$postValue='id='.$id;		

		
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
					if($user->moveToAgent($id)){
									
						redirectValue('members.php?type=c','Successfully Moved To Agent','success',$postValue);
					}											
				}
				
				else{
					redirectValue('moveCustomer.php','Password is not Valid','error',$postValue);
				}
			}
			else{
				
				redirectValue('moveCustomer.php','Missing Parameters','error',$postValue);
			}
			
		}
		echo $template;



?>