<?php class Addon{
	public $_request="";
	public $status=200;
	


	public function view($template){
		$template=new Templates($template);
		$db=new Database;
		echo $template;
	}
	
	public function get_request_method(){
		return $_SERVER['REQUEST_METHOD'];
	}
	public function response($data,$status){
		$status=($status)?$status:200;
		$this->set_header();
		echo $data;
	}
	
	public function input(){
		$request=$this->get_request_method();
		switch($request){
			case 'POST':
			$this->_request=$_POST;
			break;
			case 'GET':
			$this->_request=$_GET;
			break;
		}
	}
	
	public function set_header(){
		header("HTTP/1.1 200 All Good");
		header("Content-Type:application/json");
	}
	public function email_header($senderEmail){
			$headers = "From: " . $senderEmail . "\r\n";
			$headers .= "Reply-To: ". strip_tags($senderEmail) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			return $headers;
	}
	public function email_message($sender,$email,$subject,$body){
		$message="<html><body style='background:f2f2f2'>";
			$message.="<div style='margin:70px 20px; background-color:f2f2f2';color:#000000>";
				$message.="<table width='100%' border='0' cellspaciong='0' cellpadding='0' bgcolor='f2f2f2'>";
					$message.="<td width='100%' border='0' cellspaciong='0' cellpadding='0' bgcolor='f2f2f2'>";
						$message.="<div><h2 style='text-align:center'>Site Visitor Message</h2></div>";
						$message.="<div><h3 style='text-align:left'>Name:" .$sender. "</h3></div>";
						$message.="<div><h3 style='text-align:left'>Subject:" .$subject. "</h3></div>";
						$message.="<div><h3 style='text-align:left'>Email:&nbsp;" .$email. "</h3></div>";
						$message.="<div><p style='margin:20px 50px'>Message:" .$body. "</p></div>";
					$message.="</table>";
				$message.="</td>";
			$message.="</div>";
		$message.="<body></html>";
		return $message;
	}
	


}

?>