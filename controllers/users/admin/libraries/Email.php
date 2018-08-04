<?php 
class Email{
	//Init DB Variable
	private $db;
	
	/*
	 *	Constructor
	 */
	 public function __construct(){
		$this->db = new Database;
	 }
	 
	/*
	 * Register User
	 */
	 

	public function message($email,$name,$subject,$body){
		
							 
					
				foreach($email as $email)
			{
					foreach($name as $name)
				{
								
								$emailbs=strtolower(binfo()['email']);
								$name=ucfirst($name);
								$headers = 'From:'.$emailbs ; // Set from headers ;
								$cleanedFrom=$emailbs;
								$rt=date("Y-m-d H:i:s");
								
								$newtime = date('h:i:A', strtotime($rt));
								 $newDate = date('j  F  Y', strtotime($rt));
					
								$to =  $email; 
								$subject =  $subject; 
								$headers = "From: " . $cleanedFrom . "\r\n";
								$headers .= "Reply-To: ". strip_tags($cleanedFrom) . "\r\n";
								$headers .= "MIME-Version: 1.0\r\n";
								$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					
								$message = '<html><body>';
								$message.="<div align='center'>";
								$message.=" <table width='666' border='0' cellpadding='4' cellspacing='4'>
											<tr bgcolor='#9999FF'>
											  <td colspan='2'><div align='center' style='color: #FFF'><strong>
											   $subject </strong></div></td>
												</tr>
												<tr><td>- Hello $name</td></tr>
											   <tr>
										  <td colspan='2'><p>$body
										  <p/></td>
										</tr>
									
										  <td colspan='2'>&nbsp;</td>
																		</tr>
														  </table>";
										$message.="</div>";
											 
							  $message .="</table>";
							   $message .="<br>";
							   $message .="<br>";
								$message .="DISCLAIMER
								The information contained in this message is confidential and solely intended 
								for the individual or entity to whom it is addressed, or authorised to receive
								 it. If you are not the intended recipient, please do not read, you are hereby 
								 notified that any disclosure of this communication, copying, distribution or 
								 taking action in reliance of the contents of this 
								 information is strictly prohibited and may be unlawful. If you received this mail
								 in error, kindly inform the sender and delete the mail. Thank you for your kind gesture.";
									  
								  $message .= "</body></html>";

								
										
									$to   = $email;
									$sent = mail($to, $subject, $message, $headers) ; 
										
						
				}
			}
										
				
								return true;
		
		
	}
		
	
		
}