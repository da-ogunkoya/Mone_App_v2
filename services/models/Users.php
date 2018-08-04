<?php

class Users{
	public $host = DB_HOST;
	public $user = DB_USER;
	public $pass = DB_PASS;
	public $dbname = DB_NAME;
	
	public $db;
	public $dbh;
	public $error;
	public $stmt;

	public function __construct(){
			// Set DSN
		$this->db = new Database;	
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

	public function newPassword($email,$password,$cpassword){
			$password = md5($password);

		if($this->checkEmail($email,'new_customer')){
				if($this->resetPassword($email,$password,'new_customer')){
					return true;
				}
		}
		else{
				if($this->checkEmail($email,'agent')){
					if($this->resetPassword($email,$password,'agent')){
					return true;
				}

		}
			else{
				return false;
			}

		}

	}

	private function resetPassword($email,$password,$table){
		$this->db->query("UPDATE $table SET password =  :password WHERE email = :email");
		$this->db->bind(':email', $email);
		$this->db->bind(':password', $password);
		$this->db->execute();
	}


//get business information i the database
		public function bDetails(){
			$buinfo=array();
			$this->db->query("SELECT * FROM busy  ORDER BY id DESC LIMIT 1");
			$this->db->execute();
			$result = $this->db->single();


				$_SESSION['server']=DB_HOST;
				$_SESSION['pass']=DB_PASS;
				$_SESSION['user']=DB_USER;
				$_SESSION['db']=DB_NAME;
		
				$_SESSION['name1']=$result->name1;
				$_SESSION['name2']=$result->name2;
				$_SESSION['slogan1']=$result->slogan1;
				$_SESSION['email']=$result->email;
				$_SESSION['email2']=$result->email2;
				$_SESSION['address']=$result->address;
				$_SESSION['postcode']=$result->postcode;
				$_SESSION['tel1']=$result->tel1;
				$_SESSION['tel2']=$result->tel2;
				$_SESSION['tel3']=$result->tel3;
				$_SESSION['web1']=$result->web1;
				$_SESSION['web']=$result->web1;
				$_SESSION['ecredit']=$result->ecredit;
				$_SESSION['ecal']=$result->ecal;
				$_SESSION['br']=$result->br;
				$_SESSION['brc']=$result->brc;
				$_SESSION['dtl']=$result->dtl;
				$_SESSION['dtls']=$result->dtls;
				$_SESSION['mtls']=$result->mtls;
				$_SESSION['vdtl']=$result->vdtl;
				$_SESSION['etp']=$result->etp;
				//$_SESSION['rp']=$result['rp'];
				$_SESSION['so']=$result->so;
				$_SESSION['rt']=$result->rt;
					
			return $result;
		}
//register / validate user	
			public function register($data){
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

			

		$this->db->query("INSERT into new_customer SET fname=:fname,lname=:lname,mname=:mname,pnumber=:phone,email=:email,password=:password,dob=:dob,postcode=:postcode,company=:company,line1=:line1,line2=:line2,line3=:line3,town=:town,county=:county,country=:country,address=:address,active=:active,date_reg=:date_reg,hash=:hash,agrs='N'");
			//bind values
			$this->db->bind(':fname', $fname);
			$this->db->bind(':lname', $lname);
			$this->db->bind(':mname', $mname);
			$this->db->bind(':phone', $phone);
			$this->db->bind(':email', $email);
			$this->db->bind(':password', $password);
			$this->db->bind(':dob', $dob);
			$this->db->bind(':postcode', $postcode);
			$this->db->bind(':company', $company);
			$this->db->bind(':line1', $line1);
			$this->db->bind(':line2', $line2);
			$this->db->bind(':line3', $line3);
			$this->db->bind(':town', $town);
			$this->db->bind(':county', $county);
			$this->db->bind(':country', $country);
			$this->db->bind(':address', $address);
			$this->db->bind(':active', $active);
			$this->db->bind(':date_reg', $date_reg);
			$this->db->bind(':hash', $hash);
			
		
			if($this->db->execute()){
						if($this->sendEmail($email,$hash)){
							return true;
				}
			}
		}



			public function passwordReset($email){

			$web=strtolower($this->bDetails()->web1);
				$bemail=strtolower($this->bDetails()->email);
				$subject="Password Reset";
				$body="Please the Link below to reset your password";
				$body.='<br/><br/><br/>';
				$body.='<a href=http://'.($web).'/moneytransfer/new_password.php?email='.$email."'>".'Click Here To Reset'.'</a><br/><br/>';
				$body.="You can copy and paste the link below to your browser"."<br/><br/>";
				$body.='http://'.$web.'/moneytransfer/new_password.php?email='.$email;
				$sent = mail($email , $subject, $this->emailBody($email,$subject,$body), $this->emailHeader(($bemail))); 
				if($sent){
					return true;
				}

		}

		public function sendEmail($email,$hash){

			$web=strtolower($this->bDetails()->web1);
				$bemail=strtolower($this->bDetails()->email);
				$subject="Email Confirmation";
				$body="Please Confirm Your email By Clicking The Link Below";
				$body.='<br/><br/><br/>';
				$body.='<a href=http://'.($web).'/moneytransfer/services/verify?email='.$email.'&hash='.$hash."'>".'Click Here To Confirm'.'</a><br/><br/>';
				$body.="You can copy and paste the link below to your browser"."<br/><br/>";
				$body.='http://'.$web.'/moneytransfer/services/verify?email='.$email.'&hash='.$hash;
				$sent = mail($email , $subject, $this->emailBody($email,$subject,$body), $this->emailHeader(($bemail))); 
				if($sent){
					return true;
				}

		}
		public function emailHeader($senderEmail){
			$headers = "From: " . $senderEmail . "\r\n";
			$headers .= "Reply-To: ". strip_tags($senderEmail) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			return $headers;
	}
	public function emailBody($email,$subject,$body){
		$message="<html><body style='background:f2f2f2'>";
			$message.="<div style='margin:70px 20px; background-color:f2f2f2';color:#000000>";
				$message.="<table width='100%' border='0' cellspaciong='10' cellpadding='10' bgcolor='f2f2f2'>";
					$message.="<td width='100%' border='0' cellspaciong='0' cellpadding='0' bgcolor='f2f2f2'>";
						$message.="<div><h2 style='text-align:center'>".$subject."</h2></div>";;
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
			$this->db->query('SELECT email,hash FROM new_customer WHERE email=:email && hash=:hash');
			$this->db->bind(':email',$email);
			$this->db->bind(':hash',$hash);
		$this->db->execute();
		if($this->db->rowCount() > 0 )
			{
				$this->db->query("UPDATE new_customer SET active=1 WHERE email = :email");
					$this->db->bind(':email',$email);
					$this->db->execute();
				return true;
			}
	}
	
}


?>