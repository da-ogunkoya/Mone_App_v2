<?php

class Login extends Users{

	public $db;

	public function __construct(){
			// Set DSN
		$this->db = new Database;	
	}
	

	public function loginTrue($email,$password,$name = NULL, $id = NULL){
		
		if (!($this->checkEmail($email,'agent'))){
//check for customer email,pasword match & user activeness
				if($this->checkEmail($email,'new_customer')){
							if($this->passwordMatchEmail($email,$password,'new_customer')){
								if($this->isUserActive($email,'new_customer')){
									$r=$this->checkType($email,'new_customer');
									if($r['status']){
										return array('details'=>'Log in Succesful','type'=>$r['type'],'level'=>$r['level'],'status'=>'success');
									}

								}
								else{
									return array('details'=>'Your Account is Inactive','type'=>'error','status'=>false);
								}
							}
							else{
							return array('details'=>'Wrong Password','type'=>'error','status'=>false);
							}
				}

				else{
// social-media register/check
					if($password =='social'){
							$name=explode(' ',$name);
							$fname=$name[0];
							$lname=$name[1];
							$email=($email=="")? $id: $email;
//initiate new object class
							$values = new stdClass();
							$values->fname = $fname;
							$values->lname = $lname;
							$values->email = $email;
							$values->title = "";
							$values->type = 'customer';
							$values->password = 'password';

						$r = array('fname'=>$fname, 'lname'=>$lname,'email'=>$email,'type'=>'customer','level'=>0,'password'=>'social');
						  $this->submitUser($r);				//submit new entry
						  $this->checkType($email,'new_customer');
						return array('details'=>'Log in Succesful','type'=>$r['type'],'level'=>$r['level'],'status'=>'success');
						}
						
					else{
					return array('details'=>'Email Does Not Exist','type'=>'error','status'=>false);
					}
				}
		}
//check for agent password match and user active
		else{
						if($this->passwordMatchEmail($email,$password,'agent')){
							if($this->isUserActive($email,'agent')){
									$r=$this->checkType($email,'agent');
									if($r['status']){	
									return array('details'=>'Log in Succesful','type'=>$r['type'],'level'=>$r['level'],'status'=>'success');		
									}
								}
								else{
									return array('details'=>'Your Account is Inactive','type'=>'error','status'=>false);
								}
						}
						else{
							return array('details'=>'Wrong Password','type'=>'error','status'=>false);
						}
			}

	}

//check email exist
			private function checkEmail($email,$table){
					$this->db->query("SELECT email FROM $table WHERE email=:email ");
					$this->db->bind(':email', $email);
					$this->db->execute();
					if($this->db->rowCount()>0){
						return true;
					}
				}
//check password match email
			private function passwordMatchEmail($email,$password,$table){
//check for social login	
					if($password =='social'){
						return true;
					}
					else{
							$password=md5($password);
						$this->db->query("SELECT email,password FROM $table WHERE email=:email && password=:password");
						$this->db->bind(':email', $email);
						$this->db->bind(':password', $password);
						$this->db->execute();
						if($this->db->rowCount()>0){
							return true;
						}
					}
				}
//check if user is active				
			private function isUserActive($email,$table){
					$this->db->query("SELECT email,active FROM $table WHERE email=:email && active=1");	
					$this->db->bind(':email', $email);
					$this->db->execute();
					if($this->db->rowCount()>0){
						return true;
					}
				}
//check user type:customer or agent
			private function checkType($email,$table){
				$r = array();
				$this->db->query("SELECT * FROM $table WHERE email=:email && active=1");	
					$this->db->bind(':email', $email);
					$this->db->execute();
					if($this->db->rowCount()>0){
						$r=$this->db->single();

						$type=$table=='agent'?$r->type:'customer';
						$level=$r->level;
						$this->initialis($r,$type,$email,$table);
		//submit last login
						$_SESSION['date']=$this->lastLogin($email);
						return array('level'=>$level,'type'=>$type,'status'=>true);
					}
			}
//set business details on panel
			private function initialis($r,$type,$email,$table){
				//$email = "da.ogunkoya@gmail.com";
				//$table = "new_customer";

					//$this->db->query("SELECT * FROM $table WHERE email = :email");
					//Bind Values
					//$this->db->bind(':email', $data['email']);
					//$r = $this->db->single();

					$_SESSION['user_id'] = $r->id;
					$_SESSION['level'] = $r->level;
					$_SESSION['fname'] = $r->fname;
					$_SESSION['lname'] = $r->lname;
					$_SESSION['mname'] = $r->mname;
					$_SESSION['email'] = $r->email;
					
					$this->bDetails();
					$run = $type=='customer'?$this->setUserDataCustomer($r):
					($r->type=='admin'?$this->setUserDataAdmin($r):$this->setUserDataAgent($r));

					$_SESSION['timestamp']=time();
					$_SESSION['id2']=$r->id;
					$_SESSION['id']='LLL'."1100".$r->id;
					$_SESSION['s_fname']=$r->fname."  ".$r->lname;
					$_SESSION['agfname']=$r->fname."  ".$r->lname;
					$_SESSION['s_fname_ad']=$r->fname."  ".$r->lname;
					$_SESSION['title']=$r->title;
					$_SESSION['type']=$type;
					$_SESSION['level']=$r->level;
					$_SESSION['log_type']=$type;
					//$_SESSION['email']=$email;
					$_SESSION['email_ad']=$r->email;
					$_SESSION['passt']=$r->password;	
				
			}

				private function setUserDataAdmin($rowad){
		
					$_SESSION['is_logged_in'] = true;
					$_SESSION['type'] =  $rowad->type;
					$_SESSION['user_id'] = $rowad->id;
					$_SESSION['level'] = $rowad->level;
					$_SESSION['fname'] = "my admin";
					$_SESSION['lname'] = $rowad->lname;
					$_SESSION['mname'] = $rowad->mname;
					$_SESSION['email'] = $rowad->email;
					$_SESSION['photo'] = $rowad->myPhoto_name;
					$_SESSION['credit'] = $rowad->credit;
	
					//for system two or old system integration
					$_SESSION['timestamp'] =time();
					$_SESSION['email_ad']=$rowad->email;
					$_SESSION['passt']=$rowad->password;
					$_SESSION['s_fname']=$rowad->fname."  ".$rowad->lname;
					$_SESSION['log_type']=$rowad->type;
					$_SESSION['sfname_ad']=$rowad->fname."  ".$rowad->lname;
					$_SESSION['title']=$rowad->title;
	
	//for download
					$_SESSION['server']=DB_HOST;
					$_SESSION['pass']=DB_PASS;
					$_SESSION['user']=DB_USER;
					$_SESSION['db']=DB_NAME;
					
					}
	
// Set User Data for Agent
	
			private function setUserDataAgent($rowaa){
				
				$_SESSION['is_logged_in'] = true;
				$_SESSION['type'] =  $rowaa->type;
				$_SESSION['user_id'] = $rowaa->id;
				$_SESSION['level'] = $rowaa->level;
				$_SESSION['fname'] = $rowaa->fname;
				$_SESSION['lname'] = $rowaa->lname;
				$_SESSION['mname'] = $rowaa->mname;
				$_SESSION['email'] = $rowaa->email;
				$_SESSION['photo'] = $rowaa->myPhoto_name;
				$_SESSION['credit'] = $rowaa->credit;
				$_SESSION['timestamp']=time();
			
			}
	
	 // Set User Data for Customer
	 
				private function setUserDataCustomer($rowcc){
					
					$_SESSION['is_logged_in'] = true;
					$_SESSION['type'] = "customer";
					$_SESSION['user_id'] = $rowcc->id;
					$_SESSION['level'] = 0;
					$_SESSION['fname'] = $rowcc->fname;
					$_SESSION['lname'] = $rowcc->lname;
					$_SESSION['mname'] = $rowcc->mname;
					$_SESSION['email'] = $rowcc->email;
					$_SESSION['photo'] = $rowcc->myPhoto_name;
					$_SESSION['credit'] = $rowcc->credit;
					$_SESSION['timestamp']=time();
				}
//record last login
			private function lastLogin($email){
				$stmt=$this->db->query("SELECT email,id,date FROM last_login WHERE email=:email ORDER BY id DESC LIMIT 1");
				$this->db->bind(':email', $email);
				$this->db->execute();
				
				if($this->db->rowCount()==0){
					$dtime = date("Y-m-d H:i:s a", time());
					$timenow = date("h:i:A", strtotime($dtime));
					$stmt=$this->db->query("INSERT INTO last_login(email,time,date) VALUES(:email,:timenow,:dtime)");
					$this->db->bind(':email',$email);
					$this->db->bind(':timenow', $timenow);
					$this->db->bind(':dtime', $dtime);
					$this->db->execute();
				}
				else{
					$r=$this->db->single();
					return $r->date;
				}
			}

	

	
}


?>