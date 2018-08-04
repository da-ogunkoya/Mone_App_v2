<?php 
class Transaction{
	//Init DB Variable
	private $db;
	
	/*
	 *	Constructor
	 */
	 public function __construct(){
		$this->db = new Database;
	 }
	 
	/*
	 * Register User
	 */
	 

	public function turnoverAgentTrans($table,$nmonth,$id){
		$query="SELECT
    YEAR(date) as year,
    MONTH(date) AS month,
    SUM(total) AS total_amount,
	SUM(amt_send) AS amtsend,
	SUM(com_a) AS comd,
	SUM(com_d) AS coma,
	COUNT(amt_send) AS counted
	
	FROM $table WHERE  (status = ' Pending' || status = 'Pending' || status='PAID') $id && date
    BETWEEN DATE(NOW()) - INTERVAL (DAY(NOW()) - 1) DAY - INTERVAL $nmonth MONTH
    AND NOW()GROUP BY YEAR(date), MONTH(date)ORDER BY YEAR(date), MONTH(date)";

		$this->db->query($query);
		$row=$this->db->resultset();
		return $row;
		
		
	}
//home display	
	public function recentAgentTrans(){	
		$this->db->query("SELECT * FROM agent_cust_transaction ORDER BY date DESC LIMIT 3");
		$row= $this->db->resultset();
		return $row;
		
	}
	//home display	
	public function recentCustTrans(){	
		$this->db->query("SELECT * FROM agent_cust_transaction ORDER BY date DESC LIMIT 3");
		$row= $this->db->resultset();
		return $row;
		
	}
		
	public function transBank(){
		$this->db->query('SELECT * FROM bank ORDER BY bank');
		$row=$this->db->resultset();
		return $row;
	}	
	public function submitBank($array){
		$this->db->query("INSERT INTO bank(bank,status) VALUE(:newBank,:option)");
		$this->db->bind(':newBank',$array['newBank']);
		$this->db->bind(':option',$array['option']);
		$this->db->execute();
		return true;
		
	}
	public function deleteBank($delArray){
		$this->db->query('DELETE FROM bank WHERE id=:id');
		$this->db->bind(':id',$delArray['id']);
		$this->db->execute();
		return true;
	}
	
	public function transaction($table){
		$this->db->query($table);
		$row=$this->db->resultset();
		return $row;
		
	}
	
	public function searchOption($required){
		$query=array();
		if($required['option']=='phone'){
				$query=" (date BETWEEN ".$date1." AND ".$date2.") " ;
			}
			
		
//pending		
			if($required['option']=='pending'){
				$query['field']="status" ;
				$query['value']="'"."Pending"."'";
				$query['relation']="=";
			}

//paid		
			if($required['option']=='PAID'){
					$query['field']="status" ;
				$query['value']="'"."PAID"."'";
				$query['relation']="=";
			}
//today		
			if($required['option']=='today'){			
				$query['field']="date" ;
				$query['value']=dDate();
				$query['relation']="=";
			}	
//transfer code		
			if($required['option']=='transferCode'){
					$query['field']="receiptno" ;
				$query['value']="'".trim($required['entry']). "'";
				$query['relation']="=";
			}
//sender First Name Last	
			if($required['option']=='cFirstLastName'){
					$query['field']="sender_name" ;
				$query['value']="'".trim($required['entry'])."'";
				$query['relation']="=";
			}			
//sender Phone	
			if($required['option']=='phoneNo'){
					$query['field']="s_phone" ;
				$query['value']="'".trim($required['entry'])."'";
				$query['relation']="=";
			}
//sender Date	
			if($required['option']=='date'){
					$query['relation']=" BETWEEN ";
					$query['field']="date" ;
				$query['value']="'".($required['date1'])."'". " AND "."'".($required['date2'])."'" ;
			}			
	
			return $query;
	}
	
//receipts list -find 
			public function findReceipt($table,$receipt){
				$list=array();
			foreach($receipt as $receipt){
				$this->db->query("SELECT receiptno FROM $table WHERE id='$receipt'");
				$val=$this->db->single();
				$list[]=$val->receiptno;
			}
			return $list;
				
			}
				
//receipts list By id -find 
			public function findReceiptBYId($table,$receipt){
				
				$this->db->query("SELECT * FROM $table WHERE id='$receipt'");
				$val=$this->db->resultset();			
					return $val;			
			}
//receipts  agent id -pay agent commission
			public function findReceiptsByAgent($id){				
				$this->db->query("SELECT receiptno FROM agent_cust_transaction WHERE agid='$id' && status='PAID' &&  agent_ps='np' ");
				$val=$this->db->resultset();			
					return $val;			
			}
//Adjust payment
			public function payAdjust($receipt,$table,$choice){
			foreach($receipt as $receipt){
				$dtime=dateTime();
				$todayDate=dDate();
				$user_id=getUser()['user_id']; //user_id of person paying
				
				$this->db->query("UPDATE $table SET status = '$choice' WHERE id = '$receipt' ");
				$val=$this->db->execute();
				
				$this->recordTask($choice,$receipt);
				}
				return true;			
			}
//Adjust Delete Transaction
			public function deleteTrans($transId,$table){
					$choice="DELETE";
			foreach($transId as $transId){
				$dtime=dateTime();
				$todayDate=dDate();
				$user_id=getUser()['user_id']; //user_id of person paying


				$this->transRestore($table,$transId);
				$this->db->query("DELETE FROM $table WHERE id = $transId ");
				$val=$this->db->execute();
				
				$this->recordTask($choice,$transId);
				}
				return true;			
			}
			
//store deleted transaction
		public function transRestore($table,$transId){
			//insert into cancel table
			$table2=$table."_cancel";
				$this->db->query("INSERT INTO $table2(date,receiptno,agent_email,sender_email,sender_name,s_phone,r_name,r_phone,r_transfer,r_bank,r_idtype,
								amt_send,total,amt_local,commission,com_a,com_d,status, exchange_rate,r_actno,agent_name,agent_ps,dtime,address,postcode,town,county,country,clear)
									
								SELECT date,receiptno,agent_email,sender_email,sender_name,s_phone,r_name,r_phone,r_transfer,r_bank,r_idtype,
								amt_send,total,amt_local,commission,com_a,com_d,status, exchange_rate,r_actno,agent_name,agent_ps,dtime,address,postcode,town,county,country,clear
									 
									  FROM $table WHERE id='$transId'");
									  $val=$this->db->execute();
		}
//record activites
			public function recordTask($choice,$receipt)	{
				$this->db->query("INSERT INTO dellog(name,email,datetime,type,nametype,level)VALUE(:name,:user_id,:datetime,:type,:nametype,:level)");
				
				$this->db->bind(':name',getUser()['fname']."".getUser()['lname']);
				$this->db->bind(':user_id',getUser()['user_id']);
				$this->db->bind(':datetime',dateTime());
				$this->db->bind(':nametype',$receipt);
				$this->db->bind(':type',$choice);
				$this->db->bind(':level',getUser()['level']);
				$this->db->execute();
				
			}
			
			// Update Transaction table for agent
		public function updateAgentTrans($arrayField,$id){
			
			$this->db->query('UPDATE agent_cust_transaction SET `r_name`=:rName, `r_phone`=:rPhone, `r_transfer`=:transferMode,`r_idtype`=:modeId,
			`r_actno`=:actNo,`r_bank`=:rBank WHERE `id`=:id ');
			
			$this->db->bind(':rName', $arrayField['rName']);
			$this->db->bind(':rPhone', $arrayField['rPhone']);
			$this->db->bind(':transferMode', $arrayField['transferMode']);
			$this->db->bind(':modeId', $arrayField['modeId']);
			$this->db->bind(':actNo', $arrayField['actNo']);
			$this->db->bind(':rBank', $arrayField['rBank']);
			$this->db->bind(':id', $id);
			$this->db->execute();
	//record
			$choice="Edit-Trans";
			$this->recordTask($choice,$id);
		
			return true;
			
		}
		//Update Transaction Table for Customer
		public function updateCustTrans($arrayField,$id){
			
			$this->db->query('UPDATE cust_transaction SET `r_name`=:rName, `r_phone`=:rPhone, `r_transfer`=:transferMode,`r_idtype`=:modeId,
			`r_actno`=:actNo,`r_bank`=:rBank WHERE `id`=:id ');
			
			$this->db->bind(':rName', $arrayField['rName']);
			$this->db->bind(':rPhone', $arrayField['rPhone']);
			$this->db->bind(':transferMode', $arrayField['transferMode']);
			$this->db->bind(':modeId', $arrayField['modeId']);
			$this->db->bind(':actNo', $arrayField['actNo']);
			$this->db->bind(':rBank', $arrayField['rBank']);
			$this->db->bind(':id', $id);
			$this->db->execute();
			//record
			$choice="Edit-Trans";
			$this->recordTask($choice,$id);
		
			return true;
			
		}
		
		//fetch result of database of agent_cust transaction based on transaction id
			public function transResult($table){
			$this->db->query($table);
			//$row=$this->db->single();
			$row=$this->db->resultset();
			return $row;

		}
//note on transaction
public function insertTransMsg($transId,$message,$table){
			$this->db->query('UPDATE agent_cust_transaction SET note=:note WHERE id=:transId');
			$this->db->bind(':transId',$transId);
			$this->db->bind(':note',$message);
			$row=$this->db->execute();
	//record
			$choice="Tran-Note";
			$this->recordTask($choice,$transId);
			
			return true;
	
}
//pay agent commission
public function payAgentCom($id,$payCom,$agentName){
	$this->subComission($id,$payCom,$agentName);
	$this->db->query("UPDATE agent_cust_transaction SET agent_ps = 'yp' WHERE agid=:id && agent_ps = 'np'");
			$this->db->bind(':id',$id);
			$row=$this->db->execute();
	//recored		
			$choice="Pay-Com";
			$this->recordTask($choice,$id);
			return true;
	
}

public function subComission($id,$payCom,$agentName){
	$dtime=dateTime();
	$this->db->query("INSERT INTO clear_trans (agent_email,agid,total,agent_name,dtime,js)
							
						VALUES (:id,:id,:payCom,:agentName,'$dtime','com_cl')");
	$this->db->bind(':id',$id);
	$this->db->bind(':payCom',$payCom);
	$this->db->bind(':agentName',$agentName);
	$this->db->execute();
	return true;
}
	
		
}