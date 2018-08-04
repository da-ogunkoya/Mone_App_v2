<?php 
require_once('../config/init.php');
$template=new Template('templates/payStatus.php');
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

//find the receipt based on id & display
		if(isset($_GET['TransId'])){
		$getTransId=$_GET['TransId'];
		$transId= explode(',', $_GET['TransId']); 
		$template->count=count($transId);
		$template->receipt=$transaction->findReceipt($table,$transId);
		
	}
//table type
		$type=$table=='agent_cust_transaction'?'a':'c';
		$type="type=".$type;

//value sent for post
		$postValue="TransId=".$getTransId." &table=".$table;
		
//post,check id with passsword for agent customer
	if(isset($_POST['submit'])){
			$password=md5(trim($_POST['password']));
			$required=array('password');
													//validate Empty password	
			if($validator->isRequired($required)){
																				//validate valid password
																//table to use for administrator deleting
					$user_id=getUser()['user_id'];								//user_id from array
				if($user->checkPass($password,$user_id)){
																						
//for payment						
								$choice=trim($_POST['choice']);	
						if($choice =='PAID' || $choice == 'Pending' || $choice =='SUSPENDED'){
								if($transaction->payAdjust($transId,$table,$choice)){
									
									redirectValue('previousTransaction.php','Successfully Updated','success',$type);
								}
						}
//Delete				
						if($choice=='DELETE'){
								if($transaction->deleteTrans($transId,$table)){
									redirectValue('previousTransaction.php','Successfully Deleted','success',$type);
								}
						}	
						
						
				}
				
				else{
					redirectValue('payStatus.php','Password is not Valid','error',$postValue);
				}
			}
			else{
				
				redirectValue('payStatus.php','Missing Password','error',$postValue);
			}
			
		}
		echo $template;



?>