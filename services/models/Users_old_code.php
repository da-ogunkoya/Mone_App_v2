<?php

class Users{
	public $host = DB_HOST;
	public $user = DB_USER;
	public $pass = DB_PASSWORD;
	public $dbname = DB_DB;
	
	public $db;
	public $dbh;
	public $error;
	public $stmt;

	public function __construct(){
			// Set DSN
		$this->db = new Database;

		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
		// Set options
		$options = array (
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
		);
		// Create a new PDO instanace
		try {
			$this->dbh = new PDO ($dsn, $this->user, $this->pass, $options);
			return $this->dbh;
		}		// Catch any errors
		catch ( PDOException $e ) {
			 echo "Connection error: " .$this->error = $e->getMessage();
		}

		
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
						$r=array('fname'=>$fname,'lname'=>$lname,'email'=>$email,'id'=>'000','title'=>'None','leve'=>0,'type'=>'customer','password'=>'social');
						$this->initialis($r,$r['type'],$r['email']);
						$this->submitUser($r);
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
					$stmt=$this->dbh->prepare("SELECT email FROM $table WHERE email=:email ");
					$stmt->execute(['email'=>$email]);
					if($stmt->rowCount()>0){
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
						$stmt=$this->dbh->prepare("SELECT email,password FROM $table WHERE email=:email && password=:password");
						$stmt->execute(['email'=>$email,'password'=>$password]);
						if($stmt->rowCount()>0){
							return true;
						}
					}
				}
//check if user is active				
			private function isUserActive($email,$table){
					$stmt=$this->dbh->prepare("SELECT email,active FROM $table WHERE email=:email && active=1");	
					$stmt->execute(['email'=>$email]);
					if($stmt->rowCount()>0){
						return true;
					}
				}
//check user type:customer or agent
			private function checkType($email,$table){
				$r = array();
				$stmt=$this->dbh->prepare("SELECT * FROM $table WHERE email=:email && active=1");	
					$stmt->execute(['email'=>$email]);
					if($stmt->rowCount()>0){
						$r=$stmt->fetch();

						$type=$table=='agent'?$r['type']:'customer';
						$level=$r['level'];
						$r['user_id'] = 221;
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
					$_SESSION['fname'] = $rowad->fname;
					$_SESSION['lname'] = $r->lname;
					$_SESSION['mname'] = $r->mname;
					$_SESSION['email'] = $r->email;
					
					$this->bDetails();
					$run = $type=='customer'?$this->setUserDataCustomer($r):
					($r['type']=='admin'?$this->setUserDataAdmin($r):$this->setUserDataAgent($r));

					$_SESSION['timestamp']=time();
					$_SESSION['id2']=$r['id'];
					$_SESSION['id']='LLL'."1100".$r['id'];;
					$_SESSION['s_fname']=$r['fname']."  ".$r['lname'];
					$_SESSION['agfname']=$r['fname']."  ".$r['lname'];
					$_SESSION['s_fname_ad']=$r['fname']."  ".$r['lname'];
					$_SESSION['title']=$r['title'];
					$_SESSION['type']=$type;
					$_SESSION['level']=$r['level'];
					$_SESSION['log_type']=$type;
					//$_SESSION['email']=$email;
					$_SESSION['email_ad']=$r['email'];
					$_SESSION['passt']=$r['password'];	
				
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
				$_SESSION['type'] =  $rowaa['type'];
				$_SESSION['user_id'] = $rowaa['id'];
				$_SESSION['level'] = $rowaa['level'];
				$_SESSION['fname'] = $rowaa['fname'];
				$_SESSION['lname'] = $rowaa['lname'];
				$_SESSION['mname'] = $rowaa['mname'];
				$_SESSION['email'] = $rowaa['email'];
				$_SESSION['photo'] = $rowaa['myPhoto_name'];
				$_SESSION['credit'] = $rowaa['credit'];
				$_SESSION['timestamp']=time();
			
			}
	
	 // Set User Data for Customer
	 
				private function setUserDataCustomer($rowcc){
					
					$_SESSION['is_logged_in'] = true;
					$_SESSION['type'] = "customer";
					$_SESSION['user_id'] = $rowcc['id'];
					$_SESSION['level'] = 0;
					$_SESSION['fname'] = $rowcc['fname'];
					$_SESSION['lname'] = $rowcc['lname'];
					$_SESSION['mname'] = $rowcc['mname'];
					$_SESSION['email'] = $rowcc['email'];
					$_SESSION['photo'] = $rowcc['myPhoto_name'];
					$_SESSION['credit'] = $rowcc['credit'];
					$_SESSION['timestamp']=time();
				}
//record last login
			private function lastLogin($email){
				$stmt=$this->dbh->prepare("SELECT email,id,date FROM last_login WHERE email=:email ORDER BY id DESC LIMIT 1");
				$stmt->execute(['email'=>$email]);
				
				if($stmt->rowCount()==0){
					$dtime = date("Y-m-d H:i:s a", time());
					$timenow = date("h:i:A", strtotime($dtime));
					$stmt=$this->dbh->prepare("INSERT INTO last_login(email,time,date) VALUES(:email,:timenow,:dtime)");
					$stmt->execute(['email'=>$email,'timenow'=>$timenow,'dtime'=>$dtime]);
				}
				else{
					$r=$stmt->fetch();
					return $r['date'];
				}
			}

//get business information i the database
		protected function bDetails(){
			$buinfo=array();
			$stmt=$this->dbh->prepare("SELECT * FROM busy  ORDER BY id DESC LIMIT 1");
			$stmt->execute();
			$result=$stmt->fetch();


				$_SESSION['server']=DB_HOST;
				$_SESSION['pass']=DB_PASSWORD;
				$_SESSION['user']=DB_USER;
				$_SESSION['db']=DB_DB;
		
				$_SESSION['name1']=$result['name1'];
				$_SESSION['name2']=$result['name2'];
				$_SESSION['slogan1']=$result['slogan1'];
				$_SESSION['email']=$result['email'];
				$_SESSION['email2']=$result['email2'];
				$_SESSION['address']=$result['address'];
				$_SESSION['postcode']=$result['postcode'];
				$_SESSION['tel1']=$result['tel1'];
				$_SESSION['tel2']=$result['tel2'];
				$_SESSION['tel3']=$result['tel3'];
				$_SESSION['web1']=$result['web1'];
				$_SESSION['web']=$result['web1'];
				$_SESSION['ecredit']=$result['ecredit'];
				$_SESSION['ecal']=$result['ecal'];
				$_SESSION['br']=$result['br'];
				$_SESSION['brc']=$result['brc'];
				$_SESSION['dtl']=$result['dtl'];
				$_SESSION['dtls']=$result['dtls'];
				$_SESSION['mtls']=$result['mtls'];
				$_SESSION['vdtl']=$result['vdtl'];
				$_SESSION['etp']=$result['etp'];
				//$_SESSION['rp']=$result['rp'];
				$_SESSION['so']=$result['so'];
				$_SESSION['rt']=$result['rt'];
					
			return $result;
		}
//register / validate user	
			protected function register($data){
				$new_data=array();
			$new_data['fname']=isset($data -> fname) ?htmlspecialchars(strip_tags($data -> fname)): "";
			$new_data['lname']=isset($data -> lname ) ? htmlspecialchars(strip_tags($data -> lname)):"" ;
			$new_data['mname']=isset($data -> mname ) ? htmlspecialchars(strip_tags($data -> mname)):"" ;
			$new_data['email']=isset($data -> email) ? htmlspecialchars(strip_tags($data -> email)): "";
			$new_data['password']=isset($data -> password) ? htmlspecialchars(strip_tags($data -> password)):""  ;
			$new_data['cpassword']=isset($data -> cpassword) ? htmlspecialchars(strip_tags($data -> cpassword)) :"" ;
			$new_data['phone']=isset($data -> phone) ?htmlspecialchars(strip_tags($data -> phone)) :"" ;
			$new_data['dob']=isset($data -> dob) ? htmlspecialchars(strip_tags($data -> dob)) :"" ;
			$new_data['postcode']=isset($data -> postcode ) ? htmlspecialchars(strip_tags($data -> postcode)) : "" ;
			$new_data['company']=isset($data -> company ) ? htmlspecialchars(strip_tags($data -> company)) :"" ;
			$new_data['line1']=isset($data -> line1) ? htmlspecialchars(strip_tags($data -> line1)) :"" ;
			$new_data['line2']=isset($data -> line2 ) ? htmlspecialchars(strip_tags($data -> line2)) : "" ;
			$new_data['line3']=isset($data -> line1 ) ? htmlspecialchars(strip_tags($data -> line3)) :"" ;
			$new_data['town']=isset($data -> town ) ? htmlspecialchars(strip_tags($data -> town)) :"" ;
			$new_data['county']=isset($data -> county ) ? htmlspecialchars(strip_tags($data -> county)) : "" ;
			$new_data['country']=isset($data -> country ) ? htmlspecialchars(strip_tags($data -> country)) :"" ;
//check required fields
			if($new_data['fname'] == "" || $new_data['lname'] == ""|| $new_data['email'] == "" || $new_data['password'] == "" || $new_data['cpassword'] == "" || $new_data['postcode'] == ""){

				return array('details'=>'Please Check Required Fields', 'type'=>'error', 'status' =>false);
			}

			else{
//check Valid Email	
				if(filter_var($new_data['email'], FILTER_VALIDATE_EMAIL))
//check password match	
				{
					if($new_data['password']== $new_data['cpassword']){						
//check if email exist	
						if($this->checkEmail($new_data['email'],'new_customer')){
								return array('details'=>'Email Already Exist', 'type'=>'error', 'status' =>false);
						}
//sumit to database
						else{
							if($this->submitUser($new_data)){
									return array('details'=>'Successfully Posted', 'type'=>'success', 'status' =>true);
						}
								else{
									return array('details'=>'Something went wrong with posting', 'type'=>'error', 'status' =>false);
						}
						}
				}
					else{
						return array('details'=>'Pasword Did Not Match', 'type'=>'error', 'status' =>false);
					}
				}
				else{
					return array('details'=>'Invalid Email', 'type'=>'error', 'status' =>false);
				}
			}
			
			

			}


//submit new user
		public function submitUser($new_data){
			$fname =isset($new_data['fname'])?$new_data['fname']:"";
			$mname = isset($new_data['mname'])?$new_data['mname']:"";
			$lname = isset($new_data['lname'])?$new_data['lname']:"";
			$phone =isset($new_data['phone'])?$new_data['phone']:"";
			$email = isset($new_data['email'])?$new_data['email']:"";
			$password = isset($new_data['password'])?$new_data['password']:"";
			$dob =isset($new_data['dob'])?$new_data['dob']:"";
			$postcode = isset($new_data['postcode'])?$new_data['postcode']:"";
			$company = isset($new_data['company'])?$new_data['company']:"";
			$line1 = isset($new_data['line1'])?$new_data['line1']:"";
			$line2 = isset($new_data['line2'])?$new_data['line2']:"";
			$line3 = isset($new_data['line3'])?$new_data['line3']:"";
			$town = isset($new_data['town'])?$new_data['town']:"";
			$county = isset($new_data['county'])?$new_data['county']:"";
			$country = isset($new_data['country'])?$new_data['country']:"";
			$address=$company." ".$line1." ".$line2." ".$line3." ".$town." ".$county." ".$country;
			$active=$new_data['password']=='social'?1:0;
			$password = md5($new_data['password']);
			$date_reg=date("Y-m-d");
			$hash=md5(rand(1,1000));

		$stmt=$this->dbh->prepare("INSERT into new_customer SET fname=:fname,lname=:lname,mname=:mname,pnumber=:phone,email=:email,password=:password,dob=:dob,postcode=:postcode,company=:company,line1=:line1,line2=:line2,line3=:line3,town=:town,county=:county,country=:country,address=:address,active=:active,date_reg=:date_reg,hash=:hash,agrs='N'");
			//bind values
			$stmt->bindParam(':fname', $fname);
			$stmt->bindParam(':lname', $lname);
			$stmt->bindParam(':mname', $mname);
			$stmt->bindParam(':phone', $phone);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':dob', $dob);
			$stmt->bindParam(':postcode', $postcode);
			$stmt->bindParam(':company', $company);
			$stmt->bindParam(':line1', $line1);
			$stmt->bindParam(':line2', $line2);
			$stmt->bindParam(':line3', $line3);
			$stmt->bindParam(':town', $town);
			$stmt->bindParam(':county', $county);
			$stmt->bindParam(':country', $country);
			$stmt->bindParam(':address', $address);
			$stmt->bindParam(':active', $active);
			$stmt->bindParam(':date_reg', $date_reg);
			$stmt->bindParam(':hash', $hash);
			
		
		if($stmt->execute()){
				$web=strtolower($this->bDetails()['web1']);
				$bemail=strtolower($this->bDetails()['email']);
				$subject="Email Confirmation";
				$body="Please Confirm Your email By Clicking The Link Below";
				$body.='<br/><br/><br/>';
				$body.='<a href=http://'.($web).'/services/verify?email='.$email.'&hash='.$hash."'>". 'Click Here To Confirm'. '</a><br/><br/>';
				$body.="You can copy and paste the link below to your browser"."<br/><br/>";
				$body.='http://'.$web.'/services/verify?email='.$email.'&hash='.$hash;
				$sent = mail($email , $subject, $this->confirmation_email($email,$subject,$body), $this->email_header(($bemail))); 
				if($sent){
					return true;
				}
			}
		}
		public function email_header($senderEmail){
			$headers = "From: " . $senderEmail . "\r\n";
			$headers .= "Reply-To: ". strip_tags($senderEmail) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			return $headers;
	}
	public function confirmation_email($email,$subject,$body){
		$message="<html><body style='background:f2f2f2'>";
			$message.="<div style='margin:70px 20px; background-color:f2f2f2';color:#000000>";
				$message.="<table width='100%' border='0' cellspaciong='10' cellpadding='10' bgcolor='f2f2f2'>";
					$message.="<td width='100%' border='0' cellspaciong='0' cellpadding='0' bgcolor='f2f2f2'>";
						$message.="<div><h2 style='text-align:center'>Site Visitor Message</h2></div>";
						$message.="<div><h3 style='text-align:left'>Subject:" .$subject. "</h3></div>";
						$message.="<div><h3 style='text-align:left'>Email:&nbsp;" .$email. "</h3></div>";
						$message.="<div><p style='margin:20px 50px'>Message:" .$body. "</p></div>";
					$message.="</table>";
				$message.="</td>";
			$message.="</div>";
		$message.="<body></html>";
		return $message;
	}	

	public function verified($email,$hash){
		$stmt=$this->dbh->prepare('SELECT email,hash FROM new_customer WHERE email=:email && hash=:hash');
		$active=$this->dbh->prepare("UPDATE new_customer SET active=1 WHERE email = :email");
				$active->BindParam(':email',$email);
			$stmt->BindParam(':email',$email);
			$stmt->BindParam(':hash',$hash);

		$stmt->execute();
		if($stmt->rowCount() > 0 )
		{
			$active->execute();
			return true;
		}
	}

	
}


?>