<?php
//require_once ("addon.php");

require_once ("config/init.php");

//require_once ("models/Users.php");
class REST extends addon{
		public $mysqli=NULL;
		public $db;
		
		const DB_SERVER=DB_HOST;
		const DB_USER=DB_USER;
		const DB_PASSWORD=DB_PASS;
		const DB_DB=DB_NAME;
		
		public function __construct(){
			//parent:: __construct();
			$this->dbconnect();

			
			
		}

	private function dbconnect(){
		$this->mysqli=new mysqli(self::DB_SERVER,self::DB_USER,self::DB_PASSWORD,self::DB_DB);
	}




	
	public function processMethod(){
		$method=trim(str_replace('/','',$_REQUEST['x']));
		if((int)method_exists($this,$method) > 0){
			$this->$method();
		}
		else{
			$this->response('',406);
		}
	}

	private function paysubscription(){
		$data=json_decode(file_get_contents('php://input'));
//iniitalise object subscriotion
		$subscription = new Subscription;
		$subscription->makepayment($data);
		
	}
    
    private function api_keys(){
        if($this->get_request_method()!==$_GET){
			$this->response('',406);
			}
        $this->response($this->json(system_keys()),200);
    }


	private function subscription(){
		if($this->get_request_method()!==$_GET){
			$this->response('',406);
			}
			$this->response($this->json(["daysleft"=>subscription()['daysleft'],'amount_due'=>subscription()['amount_due'],
				"name"=>binfo()['name1']]),200);

	}

	private function info(){
		if($this->get_request_method()!==$_GET){
			$this->response('',406);
			}
			
			$this->response($this->json(binfo()),200);
	}

	private function rate(){
		if($this->get_request_method()!==$_GET){
			$this->response('',406);
			}

			$query="SELECT rate, id FROM todays_rate  ORDER BY id DESC 
                        LIMIT 1";
			$r = $this->mysqli->query($query) or die($this->mysqli->error.__LINE__);

			if($r->num_rows > 0){
				//$result=array();
				
					while($row = $r->fetch_assoc()){
						$result=$row;
					}

				$this->response($this->json($result)	,200);
		}

		
	}

	private function commission(){
		if($this->get_request_method() !==$_GET){
			$this->response('',406);
		}

		
		$com=stripslashes(trim($_GET['val']));
		$query="SELECT * FROM  `agent_cr` WHERE `to` >='$com' AND  `from` <='$com'";
		$r=$this->mysqli->query($query);
		if($r->num_rows>0){
			while($row=$r->fetch_assoc()){
				$result=$row;
			}
			$this->response($this->json($result),200);
		}
	}
	
	public function test(){
		$link='../index.html';
		$this->view($link);
	}
	
	public function contact(){	
		$sender=  @trim(stripslashes($_POST['sender'])); 
		$email=  @trim(stripslashes($_POST['email'])); 
		$subject=  @trim(stripslashes($_POST['subject'])); 
		$body=  @trim(stripslashes($_POST['message'])); 
		$admin_receiver="danielbillion@gmail.com";
//send email
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		
			
			$sent = mail($admin_receiver, $subject, $this->email_message($sender,$email,$subject,$body), $this->email_header($email)) ; 
					 if($sent){
					 $result=array('type'=>'success', 'message'=>'sent successfully');
					$this->set_header();
					 echo json_encode($result);
				 }
					 else{
						 $result=array('error'=>'406', 'message'=>'not sent');
						$this->set_header();
						 echo json_encode($result);
					 }
			}
		else{
				$result=array('error'=>'406', 'message'=>'invalid email');
				$this->set_header();
				 echo json_encode($result);
			
		}
	}	

	private function login(){
		if($this->get_request_method()!==$_GET){
			$this->response('',406);
			}

		//$db = new Database;
		$login = new Login;
		
	
		$data=json_decode(file_get_contents('php://input'));
		$password=$data->password;
		$email=isset($data -> email) ?htmlspecialchars(strip_tags($data -> email)): htmlspecialchars(strip_tags($data -> id));
	//social login	
		$name=isset($data -> name) ?htmlspecialchars(strip_tags($data -> name)): "";
		$id=isset($data -> id) ?htmlspecialchars(strip_tags($data -> id)): "";

		$r=$login->loginTrue($email,$password,$name,$id);
		$r['daysleft'] = subscription()['daysleft'];
		if($r['status']){
			$this->response($this->json($r),200);
		}
		else{
			$this->response($this->json($r),200);
		}


	}

	private function new_password(){
		
		$data=json_decode(file_get_contents('php://input'));

		$users= new Users;
		if($data->password != $data->cpassword){
			$this->response($this->json(array("details"=>'password mismatch','type'=>'error','status'=>false)),200);
		}

		else{
				$email = $data->email ;
			if($users->newPassword($email,$data->password,$data->cpassword)){
				$this->response($data->email,200);
			}
		}
		
	}


	private function forgot_password(){
		
		$data=json_decode(file_get_contents('php://input'));

		$users= new Users;
		if($users->passwordReset($data->email)){
			$this->response($data->email,200);
		}
		
	}

	private function register(){
		
		$data=json_decode(file_get_contents('php://input'));
		$users= new Users;
		$response=$users->register($data);
//success
			 if($response['status']){
				$this->response($this->json($response),200);
			}
			else{
				$this->response($this->json($response),200);
			}
			
	

	}
//verfiy registration
	private function verify(){
		if($this->get_request_method()!==$_GET){
			$this->response('',406);
			$user = new Users;
			$data=json_decode(file_get_contents('php://input'));
			$email=isset($_GET['email'])?htmlspecialchars(strip_tags($_GET['email'])):"";
			$hash=isset($_GET['hash'])?htmlspecialchars(strip_tags($_GET['hash'])):"";
			$hash = preg_replace('/\s+/', '', $hash);
				$web=$user->bDetails()->web1;
			if($user->verified($email,$hash)){
				header('Location:'.'http://'.$web.'?verify=clear');
			}
			else{
				echo "Something Went Wrong";
			}
			}
	}
	private function json($data){
		if(is_array($data)){
			return json_encode($data);
		}
	}
}

$api=new REST;
$api->processMethod();
?>