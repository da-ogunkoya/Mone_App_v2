<?php 
require_once('../config/init.php');
$template=new Template('templates/partPaid.php');
$user=new User;
$transaction=new Transaction;
$outstand=new Balance;
$validator=new Validator;

$id=(isset($_GET['Id']))?$_GET['Id']:"";


$template->receipt=$transaction->findReceiptsByAgent($id);

//find Agent Name
$template->agent=$user->agent_single($id);

//value sent for post
		$postValue="id=".$id." &type=".$_GET['type'];

//set table 
	$type=isset($_GET['type'])?$_GET['type']:pTable()['type'];	

		
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
					if($outstand->partPay($id,$type,$amount)){
									
						redirectValue('outstanding.php','Successfully Updated','success',$postValue);
					}											
				}
				
				else{
					redirectValue('partPaid.php','Password is not Valid','error',$postValue);
				}
			}
			else{
				
				redirectValue('partPaid.php','Missing Parameters','error',$postValue);
			}
			
		}
		echo $template;



?>