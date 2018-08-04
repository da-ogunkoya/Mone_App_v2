<?php 
require_once('../config/init.php');
$template=new Template('templates/note.php');
$user=new User;
$transaction=new Transaction;
$validator=new Validator;

//find table

	if(isset($_GET['table'])){
	$table=trim($_GET['table']);
	}
	else{
		$table="agent_cust_transaction";
	}


		if(isset($_GET['transId'])){
		$getTransId=$_GET['transId'];
		$transId= array($getTransId); 
		
//find the receipt based on id & display		
		$result=$transaction->findReceiptBYId($table,$getTransId);
			foreach($result as $result){
				$template->note=$result->note;
				$template->receipt=$result->receiptno;				
			}
		
	}
//table type
		$type=$table=='agent_cust_transaction'?'a':'c';
		$type="type=".$type;

//value sent over post
		$postValue="TransId=".$getTransId." &table=".$table;
		
//post,check id with passsword & message entry
	if(isset($_POST['submit'])){
			$password=md5(trim($_POST['password']));
			$required=array('password');
//validate Empty password														
			if($validator->isRequired($required)){							
																				
//Validate Password																
					$user_id=getUser()['user_id'];							
				if($user->checkPass($password,$user_id)){

//for Message Entry				
								$message=trim($_POST['message']);
								if($transaction->insertTransMsg($getTransId,$message,$table)){
									redirectValue('previousTransaction.php',' Message Successfully Submitted','success',$type);
								}												
				}
				
				else{
					redirectValue('previousTransaction.php','Password is not Valid','error',$postValue);
				}
			}
			else{
				
				redirectValue('previousTransaction.php','Missing Password','error',$postValue);
			}
			
		}
		echo $template;



?>