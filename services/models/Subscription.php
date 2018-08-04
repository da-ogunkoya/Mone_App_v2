<?php
class Subscription extends Link{

	public $mysqli;
	
	public function __construct(){
			 parent::__construct();
	}

	public function makepayment($data){
		$name = $data->name;
		$amount_due=$data->amountDue;
		$amount_paid = $data->paid;
		$company = $data->company;
		$status = 'pending';
		$ref = $data->reference;
		$date_paid = date('Y-m-d H:i:s');
		$due_date= date('Y-m-d H:i:s');
		$query = "INSERT INTO subscription(`company`, `name`,`amount_due`,`amount_paid`,`date_paid`,`due_date`,`status`,`ref`) VALUE('$company','$name','$amount_due','$amount_paid','$date_paid','$due_date','$status','$ref')";
		
		if($this->mysqli->query($query) ){
			header("HTTP/1.1 200 All Good");
			header("Content-Type:application/json");
			echo json_encode(['response'=>"paid successfully"]);
		}
		else{

		} die($this->mysqli->error.__LINE__);
	}
}

?>