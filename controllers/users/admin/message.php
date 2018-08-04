<?php 
require_once('../config/init.php');
$template=new Template('templates/message.php');
$user=new User;
$myEmail=new Email;
$transaction=new Transaction;
$validator=new Validator;

$id=(isset($_GET['Id']))?$_GET['Id']:"";
$table=(isset($_GET['table']))?($_GET['table']=='a'?'agent':'new_customer'):"";

$id= explode(',', $id); 
$result=$user->findRecord($table,$id);
$getValue="Id=".$_GET['Id']."& table=".$_GET['table'];
$template->result=$result;
//post
		if(isset($_POST['submit'])){
			$choice=trim($_POST['choice']);
			$title=trim($_POST['title']);
			$sender=trim($_POST['sender']);
			$message=trim($_POST['message']);
			$require=array('title','sender','message');
			$email=$user->email($table,$id);
			
			if($validator->isRequired($require)){
				if($choice=='sms'){
// find mobile.
						$mobile=$user->mobile($table,$id);
								foreach($mobile as $mobile){
								//$username = "danielbillion@yahoo.com";
								//$hash = "324510a2e38ac9b9a8fbe9362135601a2ce1192a";
								
								$username =binfo()['smsEmail'];
								$hash = binfo()['smsHash'];
								
								// Config variables. Consult http://api.txtlocal.com/docs for more info.
								$test = "0";

								// Data for text message. This is the text message data.
								$sender = binfo()['slogan1'];					// This is who the message appears to be from.
								$numbers = $mobile; 							// A single number or a comma-seperated list of numbers
								$message = $message;
																				// 612 chars or less
																				// A single number or a comma-seperated list of numbers
								$message = urlencode($message);
								$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
								$ch = curl_init('http://api.txtlocal.com/send/?');
								curl_setopt($ch, CURLOPT_POST, true);
								curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								$result = curl_exec($ch); // This is the result from the API
								curl_close($ch);
								redirectValue('message.php','Please Fill in the Essential Fields','success',$getValue);
							}
					
				}
				else{
					if($myEmail->message($email,$result,$title,$message)){
						redirectValue('message.php','Please Fill in the Essential Fields','success',$getValue);
						
					}
					
					
				}
				
				
			}
			else
			{
				redirectValue('message.php','Please Fill in the Essential Fields','error',$getValue);
			}
			
		}

echo $template;



?>