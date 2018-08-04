<?php
require 'config/init.php';
$template=new Template('templates/receipt_single.php');
$sender=new Senders;
$user=new User;
$trans=new Transaction;

//GET by id
	if(isset($_GET['transId'])){
		$transId=$_GET['transId'];
	$result=$trans->getTransactionById($transId);
			foreach($result as $result){
			$template->senderName=strtoupper($result->sender_name);
//request from admin			
			if(isset($_GET['tableType'])){
	//type admin as table=agent_cust_transaction
	
				if($_GET['tableType']=='agent_cust_transaction')
				{
					$template->address=strtoupper($result->address);
					$template->postcode=($result->postcode);
				}
				else {		
	//type admin as table=cust_transaction					
					 $cid=$result->cid;
					$cInfo=$user->custInfo($cid);
					foreach($cInfo as $cInfo ){
						$template->postcode=strtoupper($cInfo->postcode);
						$template->address=strtoupper($cInfo->address);
							}
					}			
			}
			
//only users- agent/customer
			else {
			
//user agent
				if((getUser()['type'])=='agent') {
					 $template->address=strtoupper($result->address);
					$template->postcode=($result->postcode);
				}
//user customer				
				else{
					$cid=$result->cid;
						$cInfo=$user->custInfo($cid);
						foreach($cInfo as $cInfo ){
							$template->postcode=strtoupper($cInfo->postcode);
							$template->address=strtoupper($cInfo->address);				
					}
				
				}
			
			}
			
			
	
			
			$template->senderPhone=$result->s_phone;
			$template->rName=strtoupper($result->r_name);
			$template->rPhone=$result->r_phone;
			$template->senderName=strtoupper($result->sender_name);
			$template->amount=number_format(($result->amt_send),2);
			$template->lAmount=number_format(($result->amt_local),2);
			$template->commission=number_format(($result->commission),2);
			$template->tAmount=number_format(($result->total),2);
			$template->tCode=strtoupper($result->receiptno);
			$template->rate=number_format(($result->exchange_rate),2);
			$template->tOption=strtoupper($result->r_transfer);
			$template->identity=strtoupper($result->r_idtype);
			$template->rActno=$result->r_actno;
			$template->bank=strtoupper($result->r_bank);
			$template->dDate=dateOnly($result->date);
			$template->dTime=timeOnly($result->dtime);
			
			
		}
}



echo $template;



 ?>