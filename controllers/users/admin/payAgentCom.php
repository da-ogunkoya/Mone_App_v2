<?php 
require_once('../config/init.php');
$template=new Template('templates/payAgentCom.php');
$user=new User;
$transaction=new Transaction;
$validator=new Validator;

$id=(isset($_GET['Id']))?$_GET['Id']:"";

//findReceipts pay commission

$template->receipt=$transaction->findReceiptsByAgent($id);

//find Agent Name
$agent=$user->agent_single($id);
$template->agent=$agent;
$agentName=$agent->fname." ".$agent->lname;

//find Total
$payCom=$user->agent($id);
$template->total=$payCom;

foreach($payCom as $payCom){
	$payCom=$payCom->payCom;
}

//value sent for post
		$postValue="id=".$id;
		
//post,check id with passsword for agent customer
	if(isset($_POST['submit'])){
			$password=md5(trim($_POST['password']));
			$required=array('password');
//Validate Empty Entry	
			if($validator->isRequired($required)){
																				
//Validate Password																
					$user_id=getUser()['user_id'];								
				if($user->checkPass($password,$user_id)){																						
//pay agent commission																				
					if($transaction->payAgentCom($id,$payCom,$agentName)){
									
						redirectValue('memberPage.php','Successfully Updated','success',$postValue);
					}											
				}
				
				else{
					redirectValue('payAgentCom.php','Password is not Valid','error',$postValue);
				}
			}
			else{
				
				redirectValue('payAgentCom.php','Missing Password','error',$postValue);
			}
			
		}
		echo $template;



?>