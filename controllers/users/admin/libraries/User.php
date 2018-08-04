<?php 
class User{
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
	 

	public function logout(){
		unset($_SESSION['is_logged_in']);
		unset($_SESSION['user_id']);
		unset($_SESSION['fname']);
		unset($_SESSION['lname']);
		unset($_SESSION['type']);
		unset($_SESSION['level']);
		
		return true;
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
		
		$table="SELECT c.*,(SELECT COUNT(id) FROM receiver I1 WHERE I1.cid=c.id) as countId,(SELECT COUNT(id) FROM cust_transaction I2 WHERE I2.cid=c.id && I2.status='Pending') as transPending,(SELECT SUM(total) FROM cust_transaction I3 WHERE I3.cid=c.id && I3.status='Pending') as sumPending,(SELECT SUM(amt_local) FROM cust_transaction I4 WHERE I4.cid=c.id && I4.status='Pending') as localPending, (SELECT COUNT(id) FROM cust_transaction I5 WHERE I5.cid=c.id) as totalTrans,  (SELECT SUM(total) FROM cust_transaction I7 WHERE I7.cid=c.id && I7.clear='uc') as outstanding, (SELECT COUNT(id) FROM cust_transaction I8 WHERE I8.cid=c.id && I8.clear='uc') as noOutstand FROM new_customer c ".$tableWhere;
		//countId for no of agent customer,no pending transaction from agent,sumPending as total pending transaction
		$this->db->query($table);
		$row= $this->db->resultset();
		return $row;
	}
//move customer to agent
public function moveToAgent($id){
	$query="INSERT INTO agent(fname,mname,lname,dob,email,pnumber,mnumber,address,postcode,hash,active,password,proofid_name,proofid_size,proofid_type,proofid_content,proofad_name,	proofad_size,proofad_type,proofad_content,date_reg,title,
	agrs,level,credit,myPhoto_name,myPhoto_size,myPhoto_type) 
	
	SELECT fname,mname,lname,dob,email,pnumber,mnumber,address,postcode,hash,active,password,proofid_name,proofid_size,proofid_type,proofid_content,proofad_name,	proofad_size,proofad_type,proofad_content,date_reg,title,
	agrs,level,credit,myPhoto_name,myPhoto_size,myPhoto_type
	FROM new_customer WHERE id=:id";
	
	$stmt=$this->db->query($query);
	$this->db->bind(':id', $id);
	if($this->db->execute()){
		if($this->deleteMember($id,'new_customer','move customer to agent')){
			return true;
		}
	}
}

	public function agent_details($id){
		$this->db->query("SELECT * FROM agent WHERE id=$id");
		$row=$this->db->resultset();
		return $row;
		
	}
//home display
	public function agentALL(){
		
		$table="SELECT a.*,COUNT(id) as countA,(SELECT COUNT(id) FROM agent WHERE active='1') as countActiveAgent,(SELECT COUNT(id) FROM agent WHERE active='0') as countSuspendAgent,(SELECT COUNT(id) FROM agent_cust_transaction I4 WHERE  I4.status='Pending') as agentTransPending, (SELECT SUM(total) FROM agent_cust_transaction I5 WHERE I5.status='Pending') as totalTrans,(SELECT COUNT(id) FROM agent_cust_transaction I5 WHERE  I5.status='SUSPENDED') as countTranSuspend, (SELECT SUM(total) FROM agent_cust_transaction I6 WHERE I6.status='SUSPENDED') as transSuspend FROM agent a ";
		
		$this->db->query($table);
		$row= $this->db->single();
		return $row;
//home display		
	}
		public function customerALL(){
		
		$table="SELECT c.*,COUNT(id) as countC,(SELECT COUNT(id) FROM new_customer WHERE active='1') as countActiveCustomer,(SELECT COUNT(id) FROM new_customer WHERE active='0') as countSuspendCustomer,(SELECT COUNT(id) FROM cust_transaction I4 WHERE  I4.status='Pending') as customerTransPending, (SELECT SUM(total) FROM cust_transaction I5 WHERE I5.status='Pending') as totalTrans,(SELECT COUNT(id) FROM cust_transaction I5 WHERE  I5.status='SUSPENDED') as countCustTranSuspend, (SELECT SUM(total) FROM agent_cust_transaction I6 WHERE I6.status='SUSPENDED') as custTransSuspend FROM new_customer c ";
		
		$this->db->query($table);
		$row= $this->db->single();
		return $row;
		
	}
	
		public function agent_single($id){
		$this->db->query("SELECT * FROM agent WHERE id=$id");
		$row=$this->db->single();
		return $row;
		
	}
		public function customer_details($id){
		$this->db->query("SELECT * FROM new_customer WHERE id=$id");
		$row=$this->db->resultset();
		return $row;
		
	}
	
	public function findIdStatus($table_query){
		$this->db->query($table_query);
		$row=$this->db->resultset();
		return $row;
	}
//member Customer results
public function memberCustomer($table){
	$this->db->query($table);
	$row=$this->db->resultset();
	return $row;
}
public function findTheMember($id,$table){
$this->db->query("SELECT * FROM $table WHERE id=$id");
$row=$this->db->single();
return $row;
		
}

	
		
	public function update($password, $id){
		
		$this->db->bind(':password', $password);
		$this->db->bind(':id', $id);
		
		$this->db->query("UPDATE agent SET password = '$password' WHERE id ='$id'");
		$this->db->execute();
			if($this->db->execute()){return true;} 
			else {return false; }
				
				return true;
	}

	public function checkPass($xpassword,$id){
			
			$this->db->query("SELECT id,password FROM agent WHERE id='$id' && password = '$xpassword'");
			$this->db->resultset();
			$val=$this->db->rowCount();
			if($val>0){
				return true;
			}
			else{
				return false;
			}
		}
//delete 
public function deleteMember($id,$table,$opType){
	$this->db->query("DELETE FROM $table WHERE id=$id");
	$this->db->execute();
	$delteFor=$id;
	$this->recordTask($opType,$delteFor);
	return true;
	
}	

//task recorder $opType=operation type $delFor=$id
public function recordTask($opType,$delteFor)	{
	//'type':operation type(opType), 'nametype' (delteFor):id
	$this->db->query("INSERT INTO dellog(name,email,datetime,type,nametype,level)VALUE(:name,:user_id,:datetime,:type,:nametype,:level)");
	
	$this->db->bind(':name',getUser()['fname']."".getUser()['lname']);
	$this->db->bind(':user_id',getUser()['user_id']);
	$this->db->bind(':datetime',dateTime());
	$this->db->bind(':nametype',$delteFor);
	$this->db->bind(':type',$opType);
	$this->db->bind(':level',getUser()['level']);
	$this->db->execute();
	
}

//update % split btw agent and busienss
public function updateSplit($id,$value){
	$this->db->query("UPDATE agent SET coma=:value,comb=:valueb WHERE id=:id");
	$valueb=100-$value;
	
	$this->db->bind(':value',$value);
	$this->db->bind(':valueb',$valueb);
	$this->db->bind(':id',$id);	
	$this->db->execute();
	return true;
	
}
//customer info
	public function custInfo($id){
			$table="SELECT * FROM new_customer WHERE id='$id'";
			$this->db->query($table);
			$row=$this->db->resultset();
			
			return $row;
			
		}
//Status change
public function updateStatus($id,$table,$choice){
if($choice==1 || $choice==-1 || $choice==0){
	$this->db->query("UPDATE $table SET active=:choice,level=0 WHERE id=:id");
}

else{
//move to manager position/admin level
	$this->db->query("UPDATE $table SET level=:choice, active=1  WHERE id=:id");
}	
	$this->db->bind(':id',$id);	
	$this->db->bind(':choice',$choice);
	$this->db->execute();
	
	$op="status-change";
	$this->recordTask($op,$id);
	return true;
	
}

//Delete Member
public function deleteMembers($id,$table){
	//$this->db->query("DELETE FROM $table WHERE id=:id");
	$this->storeMember($id,$table);
	
	$this->db->query("DELETE FROM $table WHERE id=$id");
	$this->db->bind(':id',$id);
	$this->db->execute();
	$op="DELETE-member";
	$this->recordTask($op,$id);
	return true;
	
}

public function storeMember($id,$table){
	//insert into cancel table
	$table2=$table."_cancel";
	$this->db->query("INSERT INTO $table2 (fname,lname,mname,email,password,mnumber,pnumber,dob,address,postcode,type,hash,date_reg,title,company,line1,line2,line3,town,county,country,youknow,agrs,level,credit)
				
			SELECT fname,lname,mname,email,password,mnumber,pnumber,dob,address,postcode,type,hash,date_reg,title,company,line1,line2,line3,town,county,country,youknow,agrs,level,credit
				 
				  FROM $table WHERE id=:id");
				  $this->db->bind(':id',$id);
	$this->db->execute();
	
}

//addressUploaded
		public function addressUploaded($getValue,$listArray){
			
			$allowedExts=array('gif','jpg','jpeg', 'png','pdf');
			$temp=explode('.',$_FILES["imageAdd"]["name"]);
			$extension=end($temp);
			
			if(($_FILES["imageAdd"]["type"]=="image/jpeg") || ($_FILES["imageAdd"]["type"]=="image/png") ||
			($_FILES["imageAdd"]["type"]=="image/gif") || ($_FILES["imageAdd"]["type"]=="image/jpg") &&
			in-array('$extension','$allowedExts') && ($_FILES["imageAdd"]["size"]<100000)
			){
				if($_FILES["imageAdd"]["error"]>0){
					
					redirectValue('mModify.php',$_FILES["imageAdd"]["error"],'error',$getValue);
				}
				
				else{
					if(file_exists("../img/".$listArray['type']."/address/".$_FILES["imageAdd"]["name"])){
						redirectValue('mModify.php','File Already Exist,if different Please rename it ','error',$getValue);
						
					}
					else{
						move_uploaded_file($_FILES["imageAdd"]["tmp_name"],"../img/".$listArray['type']."/address/".$_FILES["imageAdd"]["name"]);
						return true;
					}
				}
				
				
			}
			else{
				redirectValue('mModify.php','image not in the right format or too lage','error',$getValue);
			}
		}
		
//myphotoUploaded
		public function myphotoUploaded($getValue,$listArray){
			
			$allowedExts=array('gif','jpg','jpeg', 'png','pdf');
			$temp=explode('.',$_FILES["myPhoto"]["name"]);
			$extension=end($temp);
			
			if(($_FILES["myPhoto"]["type"]=="image/jpeg") || ($_FILES["myPhoto"]["type"]=="image/png") ||
			($_FILES["myPhoto"]["type"]=="image/gif") || ($_FILES["myPhoto"]["type"]=="image/jpg") &&
			in-array('$extension','$allowedExts') && ($_FILES["myPhoto"]["size"]<100000)
			){
				if($_FILES["myPhoto"]["error"]>0){
					
					redirectValue('mModify.php',$_FILES["myPhoto"]["error"],'error',$getValue);
				}
				
				else{
					if(file_exists("../img/".$listArray['type']."/photo/".$_FILES["myPhoto"]["name"])){
						redirectValue('mModify.php','File Already Exist,if different Please rename it ','error',$getValue);
						
					}
					else{
						move_uploaded_file($_FILES["myPhoto"]["tmp_name"],"../img/".$listArray['type']."/photo/".$_FILES["myPhoto"]["name"]);
						return true;
					}
				}
				
				
			}
			else{
				redirectValue('mModify.php','image not in the right format or too lage','error',$getValue);
			}
		}
//idUploaded
		public function idUploaded($getValue,$listArray){
			
			$allowedExts=array('gif','jpg','jpeg', 'png','pdf');
			$temp=explode('.',$_FILES["imageId"]["name"]);
			$extension=end($temp);
			
			if(($_FILES["imageId"]["type"]=="image/jpeg") || ($_FILES["imageId"]["type"]=="image/png") ||
			($_FILES["imageId"]["type"]=="image/gif") || ($_FILES["imageId"]["type"]=="image/jpg") &&
			in-array('$extension','$allowedExts') && ($_FILES["imageId"]["size"]<100000)
			){
				if($_FILES["imageId"]["error"]>0){
					
					redirectValue('mModify.php',$_FILES["imageId"]["error"],'error',$getValue);
				}
				
				else{
					if(file_exists("../img/".$listArray['type']."/id/".$_FILES["imageId"]["name"])){
						redirectValue('mModify.php','File Already Exist,if different Please rename it ','error',$getValue);
						
					}
					else{
						move_uploaded_file($_FILES["imageId"]["tmp_name"],"../img/".$listArray['type']."/id/".$_FILES["imageId"]["name"]);
						return true;
					}
				}
				
				
			}
			else{
				redirectValue('mModify.php','image not in the right format or too lage','error',$getValue);
			}
		}
		
//Update member info
		public function updateAgent($listArray,$id,$type){
			
			$type=$type=='agent'?'agent':'new_customer';
			
			$table="UPDATE $type SET email=:email,pnumber=:contact, mnumber=:mobile ,fName=:fName,lName=:lName,address=:address,postcode=:postcode,proofid_name=:proofId_name , proofid_size=:proofId_size,proofid_type=:proofId_type,proofad_name=:proofad_name,proofad_size=:proofad_size,proofad_type=:proofad_type ,myPhoto_name=:myPhoto_name,myPhoto_size=:myPhoto_size,myPhoto_type=:myPhoto_type WHERE id='$id'";
			
			$this->db->query($table);
			
			$this->db->bind(':email',$listArray['email']);
			$this->db->bind(':mobile',$listArray['mobile']);
			$this->db->bind(':contact',$listArray['contact']);
			$this->db->bind(':fName',$listArray['fName']);
			$this->db->bind(':lName',$listArray['lName']);
			
			$this->db->bind(':address',$listArray['address']);
			$this->db->bind(':postcode',$listArray['postcode']);
			$this->db->bind(':proofId_name',$listArray['proofId_name']);
			$this->db->bind(':proofId_size',$listArray['proofId_size']);
			$this->db->bind(':proofId_type',$listArray['proofId_type']);
			
			$this->db->bind(':proofad_name',$listArray['proofad_name']);
			$this->db->bind(':proofad_size',$listArray['proofad_size']);
			$this->db->bind(':proofad_type',$listArray['proofad_type']);
			
			$this->db->bind(':myPhoto_name',$listArray['myPhoto_name']);
			$this->db->bind(':myPhoto_size',$listArray['myPhoto_size']);
			$this->db->bind(':myPhoto_type',$listArray['myPhoto_type']);
			$row=$this->db->execute();
			
			return true;
			
		}
		
		public function findActivities($id,$start,$end){
			$this->db->query("SELECT * FROM dellog WHERE email=:id  ORDER BY id DESC LIMIT $start,$end");
			$this->db->bind(':id',$id);
			$row=$this->db->resultset();
			return $row;
		}
//Add credit/
public function addCredit($id,$table,$amount){
	$this->db->query('UPDATE agent SET `credit`=:amount WHERE `id`=:id');
	
	$this->db->bind(':id',$id);
	$this->db->bind(':amount',$amount);
	$this->db->execute();
	
	
	return true;
	
}
//find user details for display
public function findRecord($table,$id){
	$row=array();
	foreach($id as $id){
		$this->db->query("SELECT fname,lname,email,mnumber,pnumber FROM $table WHERE id=:id");	
		$this->db->bind(':id',$id);
		$result=$this->db->single();
		$email=$result->email==""?"":"/".$result->email;
		$mobile=$result->mnumber==""?"":"/".$result->mnumber;
		$row[]=$result->fname." ".$result->lname.$email.$mobile ;	
	}
	return $row;
}
//find mobile no
	public function mobile($table,$id){
		$row=array();
		foreach($id as $id){
			$this->db->query("SELECT mnumber FROM $table WHERE id=:id");	
			$this->db->bind(':id',$id);
			$result=$this->db->single();		
			$row[]=$result->mnumber ;	
		}
		return $row;
	}
	
		public function email($table,$id){
		$row=array();
		foreach($id as $id){
			$this->db->query("SELECT email FROM $table WHERE id=:id");	
			$this->db->bind(':id',$id);
			$result=$this->db->single();		
			$row[]=$result->email ;	
		}
		return $row;
	}
	
	
}