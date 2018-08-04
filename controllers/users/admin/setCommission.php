<?php require('../config/init.php'); ?>
<?php

//Get Template & Assign Vars 
$template = new Template('templates/setCommission.php');
$trans=new Setup;
$validator=new Validator;

//GET id set
	if(isset($_GET['Id'])){
		$id=$_GET['Id'];
		$template->result=$trans->comTableAgent($id);
		$getValue="Id=".$id;
		$template->user_id=$id;
	}



//No GET id set
else{
//Display table based on type	
				$id="none";
			
				if(isset($_GET['type'])){
							if(($_GET['type']=='a')){		
								
								$template->result=$trans->comTableAgent($id);
							}				
							if(($_GET['type']=='c')){
								
								$template->result=$trans->comTableCust();
							}
					}

					else{
						$template->result=$trans->comTableAgent($id);
					}
		}

//POST Submit for new entry
			
		if(isset($_POST['submit'])){
			$amountFrom=trim($_POST['amountFrom']);
			$amountTo=trim($_POST['amountTo']);
			$value=trim($_POST['value']);
			$rate=trim($_POST['rate']);
			
			$arrayValue=array();
			$arrayValue['amountTo']=$amountTo;
			$arrayValue['amountFrom']=$amountFrom;
			$arrayValue['value']=$value;
			$arrayValue['rate']=$rate;
			
			//check for empty entry
			$required=array('amountFrom','amountTo','value','rate');
			$trans=new Setup;
			$validator=new Validator;
			
			$getValue=$getValue==""?"":$getValue;
			if(isset($_GET['type'])){
				$type=$_GET['type'];
				if($type=='c'){
					$getValue="type=c";
					}
					else{
					$getValue="type=a";	
					}
			}
			
			if($validator->isRequired($required)){
				if($trans->rangeNotExist($arrayValue)){
						$id=isset($_GET['Id'])?$_GET['Id']:"";
					if($trans->newRange($arrayValue,$id)){
						redirectValue('setCommission.php','New Commission Range Successful','success',$getValue);
					}
				}
				
				else{
					redirectValue('setCommission.php','Your entry is already in existence, Please Check','error',$getValue);
				}
				
			}	
			
			else{
				redirectValue('setCommission.php','One of Your Entry is Empty','error',$getValue);
			}
			
			
			
			
		}

//Delete Range from Agent_cr/cust_cr
		if(isset($_GET['rangeId'])){
				$id=trim($_GET['rangeId']);
			if($trans->delRange($id)){				
//redirect to memeber id
					if(isset($_GET['Id'])){
						redirectValue('setCommission.php','Range Successfully Deleted','success',$getValue);
						
					}
//redirection agent/customer
					else{
						if($_GET['type']=='c'){
							$getValue='type=c';
						redirectValue('setCommission.php','Range Successfully Deleted','success',$getValue);
						}
						else{
							redirect('setCommission.php','Range Successfully Deleted','success');
						}
					}
			}
			else{
				redirectValue('setCommission.php','Range Successfully Deleted','success',$getValue);
			}
			
		}

	echo $template;
?>