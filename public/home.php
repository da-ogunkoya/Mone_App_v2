<?php include 'config/init.php'; ?>
<script>
			
	function onld(){
				
		$("#commission").val(0);
		$("#tAmount").val(0);
		$("#lAmount").val(0);
		$("#eRate").val(0);
	}
	
	function findval(val){
		if(val.length==0){
			
			$("#commission").val(0);
				$("#tAmount").val(0);
				$("#lAmount").val(0);
				$("#eRate").val(0);
		}
		else{
			
			
		$.post("calculator_process.php",{myoption:""+$("[name='option']:checked").val()+"",exval:""+val+""},function(data){
			 console.log(data);
			$("#commission").val(data['commission']);
				$("#tAmount").val(data['tAmount']);
				$("#lAmount").val(data['lAmount']);
				$("#eRate").val(data['eRate']);
			
		})
	}
}

 </script>
<!Doctype html>
<html>
	<head>
		<title>TWICE AFAM MONEY TRANSFER</title>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
		<meta name="keyword" content="money transfer,money transfer to Nigeria">
		<meta name="description" content="Money Transfer">
		<meta http-equiv="X-UA-Ccompatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href='https://fonts.googleapis.com/css?family=Lora|Roboto+Slab|Droid+Sans|Merriweather|Fjalla+One|Noto+Serif|Libre+Baskerville' rel='stylesheet' type='text/css'>
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link href="css/font-awesome.css" rel="stylesheet" type="text/css">
		<link href="images/fvr.png" rel="shortcut icon" type="images/jpeg">
		<link href="css/datepicker.css" rel="" type="text/css">
		
	</head>

	<body>
		<!------------------Navbar heading starts here ---->
			<div class="container">
				<nav class="navbar navbar-default navbar-fixed-top">
					  <div class="container-fluid">
						
							<div class="row">
								<div class="col-md-4">
									<div class="navbar-header ">
									 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
													<!-- Hides information from screen readers -->
												
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
										</button>
										<div class="row">
										<div class="col-md-2">
											<span class="logo"><img src="images/logo.png"></span>
										</div>
										<div class="col-md-10">
											<h2>TWICE AFAM SERVICES LTD</h2>
										</div>
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<div id="navbar" class="collapsed navbar-collapsed  navbar-right">
										<ul class="nav navbar-nav">
											<li class=""><a href="home.php">Home</a></li>
											<li><a href="moneyapp/users/APP/new_agent_reg.php">Register</a></li>
											<li><a href="moneyapp/users/login.php">Sign In</a></li>
											
										</ul>
									</div>
								</div>
							</div>
						
						
					</div>
				</nav>
			</div>
			<!------------------Navbar ends here ---->
			
			<!------------ slider  here --------------------------------------------------------------------->
				<div id="myslider" class="carousel slide" data-ride="carousel">
					  <!-- Indicators -->
					  <ol class="carousel-indicators">
						<li data-target="#myslider" data-slide-to="0" class="active"></li>
						<li data-target="#myslider" data-slide-to="1"></li>
						<li data-target="#myslider" data-slide-to="2"></li>
						
					  </ol>

					  <!-- Wrapper for slides -->
					  <div class="carousel-inner" role="listbox">
						<div class="item active">
						  <img src="images/apo.jpg" alt="...">
						  <div class="carousel-caption">
							<h2> Fast And Secure Money Transfer To Any Bank In Nigeria</h2>
						  </div>
						</div>
						
						<div class="item">
						  <img src="images/hammer.jpg" alt="...">
						  <div class="carousel-caption">
							<h2>We Are Here To Help You</h2>
						  </div>
						</div>
						
						<div class="item">
						  <img src="images/bank.jpg" alt="...">
						  <div class="carousel-caption">
							<h2>We Konnekts You To The World</h2>
						  </div>
						</div>
						
						
						...
					  </div>

					  <!-- Controls -->
					  <a class="left carousel-control" href="#myslider" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					  </a>
					  <a class="right carousel-control" href="#myslider" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					  </a>
			</div>
			<!---- slide ends her here -------------------------------------------------------------------->
			<!---------------------------- Twice-AFAM CALCULATOR ------------------------------------------>
			<section id="calculator">
				<div class="container">
					
					<div class="row">
						
								<div class="col-md-6">
									<div class="afam_calculator">
										<div class="row">
											<div class="cal_heading">
												<h3>TWICE-AFAM CALCULATOR <i class="fa fa-calculator fa-1x"></i></h3>
												<h4>&pound; 1 = &#8358; <?php  echo calculator_rate(); ?></h4>
											</div>
										</div>
										<div class="cal">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group-lg">
														<input type="text" name="amount" id="amount" onKeyUp="findval(this.value);" class="form-control" placeholder="Enter Amount To Send GBP &pound;">
													</div>
												</div>
											</div>
											
											<div class="row">
												
													<div class="col-md-3 col-md-offset-3">
														<div class="option">	
															<input type="radio"name="option" id="option"  value="pounds" checked>
															<span class="cl"><label>&pound;</label></span>
														</div>
													</div>
													
													<div class="col-md-5 col-md-offset-1">
														<div class="option">
															<input type="radio" name="option" id="option" value="naira" ><span class="cl"><label>&#8358;</label></span>
														</div>
													</div>
												
											</div>
											
											<div class="row">
												<div class="col-md-7 col-md-offset-2  ">
												
														<div class="form-group-md">
														<label>Total Amount</label>
															<input type="text" name="tAmount" id="tAmount" class="form-control" placeholder="Total Amount GBP">
														</div>	
													<div class="form-group-md">
														<label>Exchange Rate</label>
														<input type="text" name="eRate" id="eRate" class="form-control" placeholder="PayOut Rate &#8358; NGN">
													</div>
													<label>Commission</label>
													<div class="form-group-md">
														<input type="text" class="form-control" name="commission" id="commission" placeholder="FEES GPB">
													</div>	
													<label>Rerceipient Receives</label>
													<div class="form-group-md">
														<input type="text" class="form-control" name="lAmount" id="lAmount" placeholder="Local Payment &#8358; NGN">
													</div>
													
													
												</div>
											</div>
										</div>
										
										
									</div>
						</div>
						
						<!----HOw Tice-Afam Money Transfer Works------------------------------------->
								<div class="col-md-6">
									<div class="howborder">
										<div class="row">
											<div class="howitwork">	
												<h4>How Twice Afam Money Transfer Works</h4>
												
											</div>
											
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-2 col-md-offset-4">
														<div class="howimage"><img src="images/shop.png">
														</div>
														<div class="hr"></div>
													</div>
													<div class="col-md-4">
														<span><h4>Register / Visit Shop</h4></span>
													</div>
												</div>
											</div>
										</div>
										
										
										
										
										
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-2 col-md-offset-4">
														<div class="howimage">
														<i class="fa fa-user fa-3x" style="margin:10px 15px;"></i>
														</div>
														<div class="hr"></div>
													</div>
													<div class="col-md-4">
														<span><h4>Select Recipient</h4></span>
													</div>
												</div>
											</div>
										</div>
										
										
										
										  
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-2 col-md-offset-4">
														<div class="howimage"><img src="images/pay2.png">
														</div>
														<div class="hr"></div>
													</div>
													<div class="col-md-4">
														<span><h4>Make Payment & We Make Payment</h4></span>
													</div>
												</div>
											</div>
										</div>
										
									</div>
							</div>
						</div>
						
				</div>
			</section>
			
			<!---------------------------- ends here ------------------------------------------>
			
			<!---------------------------- WHY US ------------------------------------------>
			
				<section id="whyus" class="whyus">
					<div class="layer">
						<div class="container">
							<div class="row">
								<header><h2> WHY YOU NEED TO CHOOSE US</h2></header>
							</div>
						
						<div class="row">
						
							
									<div class="col-md-4">
										<div class="icon">
											<img src="images/security.png" alt="">
										</div>
										<div class="icon_header">
											<h3>SECURE AND RELIABLE</h3>
											<p>The personal Dettails You Registered With US Online are Securely Protected, In Accordance to Data Protection</p>
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="icon">
											<img src="images/fast.png" alt="">
										</div>
										<div class="icon_header">
											<h3>FAST AND PEAce OF MIND</h3>
											<p>We Guaranteed You Money is Sent To Any of Your Beneficary, quick and Safe</p>
										</div>
									</div>
									
									<div class="col-md-4">
										<div class="icon">
											<img src="images/process.png" alt="">
										</div>
										<div class="icon_header">
											<h3>SIMPLE PROCESS</h3>
											<p>We Offer One-Stop Service To Money Transfer To Any Where in Nigeria,with the convinience of Online and Local Shop Services</p>
										</div>
									</div>
							</div>
						
					</div>
				</section>
			</div>
			
			<!---------------------------- ends here ------------------------------------------>
			
			
		<footer>
			
			<div class="container">
				<div class="row">
					<div class="col-md-6">
					<p> &copy;2016 Twice Afam Services Limited. All Right Reserved.
					TransferWise is authorised by the Financial Conduct Authority under the Electronic Money Regulations 2011 </p>
					</div>
					<div class="col-md-6">
						<div class="socialmedia">
								<span class="fa-stack fa-1x">
									<i class="fa fa-facebook fa-3x fa-stack-2x"></i>
									<i class="fa fa-check-circle fa-stack-1x fa-inverse"></i>
								</span>
								
								<span class="fa-stack fa-1x">
									<i class="fa fa-twitter fa-3x fa-stack-2x"></i>
									<i class="fa fa-check-circle fa-stack-1x fa-inverse"></i>
								</span>
								
								<span class="fa-stack fa-1x">
									<i class="fa fa-google-plus fa-3x fa-stack-2x"></i>
									<i class="fa fa-check-circle fa-stack-1x fa-inverse"></i>
								</span>>
						</div>
					</div>
					
				</div>
			</div>
		</footer>
	
	</body>

<script src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>