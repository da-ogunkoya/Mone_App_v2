<?php 
class Balance{
	//Init DB Variable
	private $db;
	
//	Constructor

	 public function __construct(){
		$this->db = new Database;
	 }
	 
	 
	 	public function agent($id){
	//$tableWhere is used if id is set for WHERE clause	
		$tableWhere=$id==""?"":"WHERE id=".$id;
		
		$table="SELECT a.*,(SELECT COUNT(id) FROM agent_new_customer I1 WHERE I1.agid=a.id) as countId,(SELECT COUNT(id) FROM agent_cust_transaction I2 WHERE I2.agid=a.id && I2.status='Pending') as transPending,(SELECT SUM(total) FROM agent_cust_transaction I3 WHERE I3.agid=a.id && I3.status='Pending') as sumPending,(SELECT SUM(amt_local) FROM agent_cust_transaction I4 WHERE I4.agid=a.id && I4.status='Pending') as localPending, (SELECT COUNT(id) FROM agent_cust_transaction I5 WHERE I5.agid=a.id) as totalTrans,(SELECT SUM(com_a) FROM agent_cust_transaction I6 WHERE I6.agid=a.id && I6.agent_ps='np' && I6.status='PAID') as payCom, (SELECT SUM(total) FROM agent_cust_transaction I7 WHERE I7.agid=a.id && I7.clear='uc') as outstanding, (SELECT COUNT(id) FROM agent_cust_transaction I8 WHERE I8.agid=a.id && I8.clear='uc') as noOutstand FROM agent a ".$tableWhere;
		//countId for no of agent customer,no pending transaction from agent,sumPending as total pending transaction
		$this->db->query($table);
		$row= $this->db->resultset();
		return $row;
	}
	
		public function customer($id){
	//$tableWhere is used if id is set for WHERE clause	
		$tableWhere=$id==""?"":"WHERE id=".$id;
		
		$table="SELECT c.*,(SELECT COUNT(id) FROM receiver I1 WHERE I1.cid=c.id) as countId,(SELECT COUNT(id) FROM cust_transaction I2 WHERE I2.cid=c.id && I2.status='Pending') as transPending,(SELECT SUM(total) FROM cust_transaction I3 WHERE I3.cid=c.id && I3.status='Pending') as sumPending,(SELECT SUM(amt_local) FROM cust_transaction I4 WHERE I4.cid=c.id && I4.status='Pending') as localPending, (SELECT COUNT(id) FROM cust_transaction I5 WHERE I5.cid=c.id) as tot	alTrans,  (SELECT SUM(total) FROM cust_transaction I7 WHERE I7.cid=c.id && I7.clear='uc') as outstanding, (SELECT COUNT(id) FROM cust_transaction I8 WHERE I8.cid=c.id && I8.clear='uc') as noOutstand FROM new_customer c ".$tableWhere;
		//countId for no of agent customer,no pending transaction from agent,sumPending as total pending transaction
		$this->db->query($table);
		$row= $this->db->resultset();
		return $row;
		}
//memeber-agent/customer	
	public function member($id,$table){
		$this->db->query("SELECT * FROM $table WHERE id=:id");
		$this->db->bind(':id',$id);
		$row=$this->db->single();
		return $row;
	}
//sum unclear trans
	public function memberClear($id,$table){
	
		$sum=0;
			foreach($id as $id){
				$this->db->query("SELECT * FROM $table WHERE id=:id && clear='uc'");
				$this->db->bind(':id',$id);
				$val=$this->db->single();
				$sum=$sum + $val->total;
			}
			return $sum;
				
	}
		
//task recorder $opType=operation type $id=$id
public function recordTask($opType,$id)	{
	//'type':operation type(opType), 'nametype' (delteFor):id
	$this->db->query("INSERT INTO dellog(name,email,datetime,type,nametype,level)VALUE(:name,:user_id,:datetime,:type,:nametype,:level)");
	
	$this->db->bind(':name',getUser()['fname']."".getUser()['lname']);
	$this->db->bind(':user_id',getUser()['user_id']);
	$this->db->bind(':datetime',dateTime());
	$this->db->bind(':nametype',$opType);
	$this->db->bind(':type',$opType);
	$this->db->bind(':level',getUser()['level']);
	$this->db->execute();
	
}

public function clearTrans($id,$amount){
	$dtime=dateTime();
	$name=getUser()['fname']." ".getUser()['lname'];
	$this->db->query("INSERT INTO clear_trans (amt_send,cla,js,dtime,transId)VALUES (:amount,:name,'CL1','$dtime',:transId)");
	$this->db->bind(':amount',$amount);
	$this->db->bind(':name',$name);
	$this->db->bind('transId',$id);
	$this->db->execute();
}
	 
	public function partPay($id,$type,$amount){
		$table=($type=='a' || $type=='ac')?'agent':'new_customer' ;
		$opType="part-payment";
		$this->recordTask($opType,$id);
		$this->clearTrans($id,$amount);
		
		$this->db->query("UPDATE $table SET sta=:amount WHERE id=:id");
		$this->db->bind(':id',$id);
		$this->db->bind(':amount',$amount);
		$this->db->execute();
		return true;
			
	}
//clear commission
public function clearCom($transId,$table,$type){
	$table=($type=='a' || $type=='ac')?'agent_cust_transaction':'cust_transaction';
	foreach($transId as $transId){
		$this->clearComInsert($transId,$table,$type);
		$this->clearComUpdate($transId,$table);
	$this->db->query("UPDATE $table SET clear='cl' WHERE id=:transId");
		$this->db->bind(':transId',$transId);
		$this->db->execute();	
	}
	return true;
}
//insert into clearcom
private function clearComInsert($transId,$table,$type){
	$field=($type=='a' || $type=='ac')?'agid':'cid';
	$this->db->query("INSERT INTO clear_trans (transId,date,receiptno,$field,sender_email,sender_name,s_phone,r_name,r_phone,r_transfer,r_bank,r_idtype,
						amt_send,total,amt_local,commission,com_a,com_d,status, exchange_rate,r_actno,dtime,man_date)
							
						SELECT id,date,receiptno,$field,sender_email,sender_name,s_phone,r_name,r_phone,r_transfer,r_bank,r_idtype,
						amt_send,total,amt_local,commission,com_a,com_d,status, exchange_rate,r_actno,dtime,man_date FROM $table WHERE id=:transId");
		$this->db->bind(':transId',$transId);
		$this->db->execute();	
}
//uppdate after insert
private function clearComUpdate($transId,$table){
	$dtime=dateTime();
	$date=dDate();
	$name=getUser()['fname']." ". getUser()['lname'];
	$this->db->query("UPDATE clear_trans SET dtime = '$dtime',date='$date', js='CL1' ,cla='$name' WHERE transId = :transId");
		$this->db->bind(':transId',$transId);
		$this->db->execute();	
}

	
	 
}