<?php 
class Update{
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
	 
	

		
		/* *************************************************************************************** */
// update all record
			public function updateallrecord(){
			$this->db->query("SELECT id,email FROM agent");
			$row=$this->db->resultset();
			
			
			
// task 1---Creat/ Update Receiver id on all agent_cust transaction
				
				
				$this->db->query("SELECT id,b_fname,b_lname FROM agent_cust_receiver");
				$row=$this->db->resultset();
				foreach($row as $row){
				$b_fname=$row->b_fname;
				$b_lname=$row->b_lname;
				$name1=$b_fname." ".$b_lname;
				$name2=$b_fname."  ".$b_lname;
				$id=$row->id;
				
				$this->db->query("UPDATE agent_cust_transaction SET agcrid=:id WHERE (r_name like :name1 || r_name like :name2)");
				$this->db->bind(':name1',$name1);
				$this->db->bind(':name2',$name2);
				$this->db->bind(':id',$id);
				$this->db->execute();
			
			}
			
//task 2--- Creat/ Update Receiver id on all cust transaction
				
				
				$this->db->query("SELECT id,b_fname,b_lname FROM receiver");
				$row=$this->db->resultset();
				foreach($row as $row){
				$b_fname=$row->b_fname;
				$b_lname=$row->b_lname;
				
				$name1=$b_fname." ".$b_lname;
				$name2=$b_fname."  ".$b_lname;
				$name3=$b_fname."   ".$b_lname;
				$id=$row->id;
				
				$this->db->query("UPDATE cust_transaction SET crid=:id WHERE (r_name like :name1 || r_name like :name2 || r_name like :name3)");
				$this->db->bind(':name1',$name1);
				$this->db->bind(':name2',$name2);
				$this->db->bind(':name3',$name3);
				$this->db->bind(':id',$id);
				$this->db->execute();
			
			}
			
		
			
				
				
// task 3--- create a single bank record
			$this->db->query("SELECT id,b_pbank,b_abank FROM receiver");
			$row=$this->db->resultset();
			foreach($row as $row){
				$b_abank=$row->b_abank;
				$b_pbank=$row->b_pbank;
				$bank=$b_abank==""?$b_pbank:$b_abank;
				$id=$row->id;
				
				$this->db->query("UPDATE receiver SET bank=:bank WHERE id=:id");
				//$this->db->query("UPDATE agent_cust_receiver SET b_phone=:b_phone, bank=:bank WHERE id=:id");
				$this->db->bind(':bank',$bank);
				$this->db->bind(':id',$id);
				$this->db->execute();
			
			}
			
			
				
				$this->db->execute();
			
			
				
					return true;
		}
		
		
		
	/* *************************end here*************************************************** */	
		
		
}