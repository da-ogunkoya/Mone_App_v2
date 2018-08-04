<?php require('../config/init.php'); ?>

<?php


//Get Template & Assign Vars
$template = new Template('templates/editTrans.php');


$user=new User;
$trans= new Transaction;


	


	
			// List  agent	
		$transid=$_GET['transId'];	
		if(isset($_GET['tableType'])){
			$table=$_GET['tableType']=='agent_cust_transaction'?'agent_cust_transaction':'cust_transaction';	
		}
//Display result of trnsacction based on id		
		$table="SELECT * FROM $table WHERE id='$transid' ORDER BY dtime DESC ";
		$result=$trans->transResult($table);
		$template->trans_result=$trans->transResult($table);
		$template->banks=$trans->transBank();
		
		if(isset($_GET['tableType'])){
			if(($_GET['tableType']=='cust_transaction')){
					foreach($result as $result){
						$cid=$result->cid;
						$cInfo=$user->custInfo($cid);
						foreach($cInfo as $cInfo ){
							$template->postcode=strtoupper($cInfo->postcode);
							$template->address=strtoupper($cInfo->address);
							$template->country=strtoupper($cInfo->country);							
					}
				}
			}
		}


if(isset($_POST['submit'])){
	$transid=$_GET['transId'];
	$rName=trim($_POST['rName']);
	$rPhone=trim($_POST['rPhone']);
	$transferMode=trim($_POST['transferMode']);                       	
	$modeId=trim($_POST['modeId']);
	$actNo=trim($_POST['actNo']);
	$rBank=trim($_POST['rBank']);
	$arrayField=array();
	$arrayField['rName']=trim($_POST['rName']);
	$arrayField['rPhone']=trim($_POST['rPhone']);
	$arrayField['transferMode']=trim($_POST['transferMode']);
	$arrayField['modeId']=trim($_POST['modeId']);
	$arrayField['actNo']=trim($_POST['actNo']);
	$arrayField['rBank']=trim($_POST['rBank']);
	
	
//admin for customer /agent request	
		if(isset($_GET['tableType'])){
			$type=$_GET['tableType']=='agent_cust_transaction'?'a':'c';
				$type="type=".$type;
						if($_GET['tableType']=='agent_cust_transaction'){	
							if($trans->updateAgentTrans($arrayField,$transid)){
								
								redirectValue('previousTransaction.php','Edit Of Transaction Successful', 'success',$type);
							}
							else
							{redirectValue('previousTransaction.php','Something Went Wrong', 'error',$type);}
						}			

							if($_GET['tableType']=='cust_transaction'){	
								if($trans->updateCustTrans($arrayField,$transid)){
									
									redirectValue('previousTransaction.php','Edit Of Transaction Successful', 'success',$type);
								}
								else
								{redirectValue('previousTransaction.php','Something Went Wrong', 'error',$type);}
				}			
					
	}

		
	}
echo $template;
?>
