<?php require('../config/init.php'); ?>
<?php
//Get Template & Assign Vars
$template = new Template('templates/turnOver.php');
$user=new User;
$transaction=new Transaction;
$nmonth=100;

//if id set
	$id=isset($_GET['Id'])?$_GET['Id']:"";

	if(isset($_GET['type'])){
		$type=$_GET['type'];
		if($type=='a'){
//specific user
		$id=$id !==""?" && agid= ".$id:"";
		$table="agent_cust_transaction";	
		}
		else{
			$id=$id !==""?" && cid= ".$id:"";
			$table="cust_transaction";	
		}	
}

else{
		$table="agent_cust_transaction";	
}



$template->result=$transaction->turnoverAgentTrans($table,$nmonth,$id);


echo $template;


?>