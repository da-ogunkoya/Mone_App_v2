<link href="<?php echo BASE_URI; ?>templates/css/receipt.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo BASE_URI; ?>templates/css/font-awesome.css" rel="stylesheet">
<script src="<?php echo BASE_URI; ?>templates/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>

<style>

#container {
  position: relative;
	line-height:400px;
	text-align:center;
}




#container{
	text-align:center;
	margin:30px 4%;
}

*{
	
font:normal 11px/1.2em sans-serif;	
}
.newrow{
	width:100%;
	overflow:hidden;
}
.companylogo{
	text-align:center;
	display:block;
	margin:8px 25%;
}
.headerlogo{
	display:inline;
	
	float:left;	
}

.companyname{
	display:inline;
	float:left;
}
#header .companyname h1{
	font:bold 39px/1.8em "Montserrat","Playfair Display","GT Walsheim",sans-serif;
}
#header .newrow .address h4{
	font:bold 18px Comic Sans MS,"monospace","helvetica","Trebuchet MS","avenir";
}
#header .newrow .contact{
	text-transform:uppercase;
	font:bold 18px "Montserrat","Playfair Display","GT Walsheim",sans-serif;
}

#header .newrow .contact strong{
	text-transform:uppercase;
	font:bold 18px/1.6em "Montserrat","Playfair Display","GT Walsheim",sans-serif;
}
#header .newrow .contact span.email,#header .newrow .contact span.website{
	font:normal 17px tahoma,"monospace","helvetica","Trebuchet MS","avenir";
}

.item{	
line-height:4.5em;
}

.item h4{
font:bold 19px/1.5em "Playfair Display", sans-serif;


}
.item strong{
font:bold 17px/2.0em "Playfair Display", sans-serif;

}
.sheading h2{
	font:bold 22px/1.8em Comic Sans MS,"Helvetica","Gadget";
}

@media print {
  /* style sheet for print goes here */
  .noprint {
    visibility: hidden;
  }
}
</style>
<div class="col-md-9">
	<div id="centerit">
			<div id="container" class="container">
						<div id="header" class="header">
							<div class="newrow">
								<div class="companylogo ">
									<div class="headerlogo">
										<img src="img_logo.php" height="40px" width="40px">
									</div>
									<div class="companyname">
										<h1><?php echo  binfo()['name1']; ?></h1>
									</div>
								</div>
							</div>
							<div class="newrow">
								<div class="address">
									<h4><?php echo  binfo()['address']. " " .binfo()['postcode'] ; ?></h4>
								</div>
							</div>
							<div class="newrow">
								<div class="contact">
									<i class="fa fa-phone-square" aria-hidden="true"></i>
									<span class="tel"><strong><?php echo  binfo()['tel1'].",".binfo()['tel2'].", ".binfo()['tel3']; ?><strong></span>,
									<i class="fa fa-envelope" aria-hidden="true"></i>
									<span class="email"><strong><?php echo  binfo()['email']; ?></strong></span>,
										<i class="fa fa-globe" aria-hidden="true"></i>
									<span class="website"><?php echo  binfo()['web1']; ?></span>
								</div>
							</div>
							
						</div>
<!--date/time-->
						<div class="newrow">
								<div class="datetime">
									<span class="date"><?php if(isset($dDate)){ echo $dDate; } ?></span>&nbsp;&nbsp;
									<span class="time"><?php if(isset($dTime)){ echo $dTime; } ?></span>
								</div>
							</div>
							<div class="container-main">
				
				<!--SenderReceiver-->
								<div id="senderReceiver" class="senderReceiver">
<!---Sender-->
									<div class="sender">
										<div class="sheading"><h2>Sender<h2></div>
										<div class="item">
											<div class="col1">
												<h4>Sender Name</h4>
											</div>
											<div class="col2">
												<strong><?php if(isset($senderName)){
												$senderName = (strlen($senderName) > 11) ? substr($senderName,0,13).'...' : $senderName;
												 echo $senderName; } ?></strong>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="item">
											<div class="col1">
												<h4>Residence</h4>
											</div>
											<div class="col2">
												<strong><?php if(isset($address)){ 
											$address = (strlen($address) > 12) ? substr($address,0,13).'...' : $address;
													echo $address; } ?></strong>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="item">
											<div class="col1">
												<h4>Post Code</h4>
											</div>
											<div class="col2">
												<strong><?php if(isset($postcode)){ echo $postcode; } ?></strong>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="item">
											<div class="col1">
												<h4>Phone Number</h4>
											</div>
											<div class="col2">
												<strong><?php if(isset($senderPhone)){ echo $senderPhone; } ?></strong>
											</div>
										</div>
									</div>
									
<!--Receiver-->
									<div class="receiver">
										<div class="sheading"><h2>Receiver</h2></div>
									<div class="clearfix"></div>
										<div class="item">
											<div class="col1">
												<h4>Receiver Name</h4>
											</div>
											<div class="col2">

												<strong><?php if(isset($rName)){

												$rName = (strlen($rName) > 11) ? substr($rName,0,13).'...' : $rName;
												 echo $rName; } ?></strong>
											</div>
										</div>
										<div class="clearfix"></div>
									
										<div class="item">
											<div class="col1">
												<h4>Receiver Phone</h4>
											</div>
											<div class="col2">
												<strong><?php if(isset($rPhone)){ echo $rPhone; } ?></strong>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="item">
											<div class="col1">
												<h4>Destination</h4>
											</div>
											<div class="col2">
												<strong>Nigeria</strong>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
									
									
								</div>
						<div class="clearfix"></div>
<!--TRansaction-->
								<div id="transPayment" class="transPayment">
								
								<!--Transaction---->
									<div class="trans">
									<div class="sheading">
										<h2>Transaction</h2>
										</div>
										<div class="item">
											<div class="col1">
												<h4>Sending</h4>
											</div>
											<div class="col2">
												<strong> &pound;<?php if(isset($amount)){ echo $amount; } ?> </strong>
											</div>
										</div>
										<div class="clearfix"></div>
										
										<div class="item">
											<div class="col1">
												<h4>Naira Equiv</h4>
											</div>
											<div class="col2">
												<strong><?php if(isset($lAmount)){ echo $lAmount; } ?></strong>
											</div>
										</div>
										<div class="clearfix"></div>
										
										<div class="item">
											<div class="col1">
												<h4>Commission</h4>
											</div>
											<div class="col2">
												<strong>&pound;<?php if(isset($commission)){ echo $commission; } ?></strong>
											</div>
										</div>
										<div class="clearfix"></div>
										
										<div class="item">
											<div class="col1">
												<h4>Total Amount</h4>
											</div>
											<div class="col2">
												<strong>&pound;<?php if(isset($tAmount)){ echo $tAmount; } ?></strong>
											</div>
										</div>
										<div class="clearfix"></div>
										
										<div class="item">
											<div class="col1">
												<h4>Transfer Code</h4>
											</div>
											<div class="col2">
												<strong><?php if(isset($tCode)){ echo $tCode; } ?></strong>
											</div>
										</div>
										<div class="clearfix"></div>
										
										<div class="item">
											<div class="col1">
												<h4>Agent Name</h4>
											</div>
											<div class="col2">
												<strong><?php echo binfo()['slogan1'];  ?></strong>
											</div>
										</div>
										<div class="clearfix"></div>
										
									</div>
									
	<!--Payment-->
									<div class="payment">
										<div class="sheading">
										<h2>Payment</h2>
										</div>
										<div class="item">
											<div class="col1">
												<h4>Exchange Rate</h4>
											</div>
											<div class="col2">
												<strong>&pound;1 = &#8358;<?php if(isset($rate)){ echo $rate; } ?></strong>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="item">
											<div class="col1">
												<h4>Bank</h4>
											</div>
											<div class="col2">
												<strong><?php if(($bank !==""))
												{ $bank = (strlen($bank) > 12) ? substr($bank,0,13).'...' : $bank;
													echo $bank; } 
												else { echo "NONE";} ?></strong>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="item">
											<div class="col1">
												<h4>Transfer Mode</h4>
											</div>
											<div class="col2">
												<strong><?php if(isset($tOption)){ echo $tOption; } ?></strong>
											</div>
										</div>
										<div class="clearfix"></div>
										
										<div class="item">
											<div class="col1">
												<h4>Identity</h4>
											</div>
											<div class="col2">
												<strong><?php if(($identity!=="")){ echo $identity; } else { echo "NONE";} ?></strong>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="item">
											<div class="col1">
												<h4>Account No</h4>
											</div>
											<div class="col2">
												<strong><?php if(isset($rActno)){ echo $rActno; } ?></strong>
											</div>
										</div>
										<div class="clearfix"></div>
										
										<div class="item">
											<div class="col1">
												<h4>--</h4>
											</div>
											<div class="col2">
												<strong>--</strong>
											</div>
										</div>
										<div class="clearfix"></div>
										
									</div>
								</div>
									<div class="clearfix"></div>

									
							</div>
			</div>
			<hr>

			<div class="newrow">
			<div class="print noprint"><button class="btn btn-primary "  onclick="window.print();">PRINT</button>
			<span class="print noprint"><input type="button" id="movehome" value="Home" onclick="window.location = 'prevTrans.php';"></span>
		</div>
		
		</div>
						
						
		</div>
		
		
		
</div>
<script>

$("#centerit").clone().insertAfter("#dup:last");


</script>