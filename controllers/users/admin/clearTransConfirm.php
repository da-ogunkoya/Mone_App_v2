<?php 
require_once('../config/init.php');
$template=new Template('templates/clearTransConfirm.php');
$user=new User;
$transaction=new Transaction;
$balance=new Balance;
$validator=new Validator;

$id=(isset($_GET['Id']))?$_GET['Id']:"";

//set type & table ,field
	$type=isset($_GET['type'])?$_GET['type']:pTable()['type'];	
	$table=($type=='a' || $type== 'ac')?'agent_cust_transaction':'cust_transaction';
	$table2=($type=='a' || $type== 'ac')?'agent':'new_customer';
	$field=($type=='a' || $type== 'ac')?'agid':'cid';
	
$transId= explode(',', $_GET['transId']);
$template->receipt=$transaction->findReceipt($table,$transId);

//find Agent Name


//memeber
	$member=$balance->member($id,$table2);
	$template->fname=$member->fname;
	$template->lname=$member->lname;

$template->member=$member;
$agentName=$member->fname." ".$member->lname;

//find Total
$template->total=$balance->memberClear($transId,$table);	



//value sent for post
		$postValue="transId=".$_GET['transId']. " & Id=".$id. "& type=". $type;
		
//post,check id with passsword for agent customer
	if(isset($_POST['submit'])){
			$password=md5(trim($_POST['password']));
			$required=array('password');
//Validate Empty Entry	
			if($validator->isRequired($required)){
																				
//Validate Password																
					$user_id=getUser()['user_id'];								
				if($user->checkPass($password,$user_id)){																						
//pay clear commission																				
					if($balance->clearCom($transId,$table,$type)){
									
						redirectValue('clearTrans.php','Successfully Updated','success',$postValue);
					}											
				}
				
				else{
					redirectValue('clearTransConfirm.php','Password is not Valid','error',$postValue);
				}
			}
			else{
				
				redirectValue('clearTransConfirm.php','Missing Password','error',$postValue);
			}
			
		}
		echo $template;



?>