<?php include('../config/init.php'); ?>

<?php

	//Create User Object
	$user = new User;
	
	if($user->logout()){
		redirect('../../index.php','You are now logged out','success');
	} 
 else {
	redirect('index.php');
 }
