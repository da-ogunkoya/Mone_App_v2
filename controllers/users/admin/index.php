<?php include('../config/init.php'); ?>
<?php

//Get Template & Assign Vars
$template = new Template('templates/index.php');
$user=new User;
$trans=new Transaction;
$template->agent=$user->agentALL();
$template->customer=$user->customerALL();
$template->recentAgent=$trans->recentAgentTrans();
$template->recentCust=$trans->recentCustTrans();

echo $template;
?>
	