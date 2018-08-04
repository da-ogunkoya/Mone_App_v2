
<!doctype html>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="shortcut icon" href="img_fvr.php" type="image/jpeg" />
   <link rel="stylesheet" href="controllers/users/templates/css/bootstrap.css" type="text/css" />
   <link rel="stylesheet" href="controllers/users/templates/css/login.css" type="text/css" />
   <link rel="stylesheet" href="controllers/users/templates/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" />
  
<title> Login Form</title>
  
</head>
<body ng-app="myApp" ng-controller="myCtrl" ng-cloak>


  <section id="main">
			<div class = "row">
				<div class="col-sm-8">
				</div>
				<div class="col-sm-4">
					<div class="login">
						<div class="converter " ng-controller="exchangeCtrl">
							<div class="row">
								<div class="col-md-6">
									<input type = "text" class="form-control" placeholder="Amount Amount To Send" ng-model="send" ng-keyup="process(send)">
								</div>
								<div class="col-md-6">
									<h4><strong style="color:white">£1 = {{rate|currency:'£'}}</strong></h4>
								</div>
							</div>
							<br/>
							<div class="row">
								<div class="bg-success response">
									<div >
										<h4><strong><u>Summary</u></strong></h4>
									</div>
									<div>
										<h4>Fee: {{commission| currency:'£'}}</h4>
									</div>
									<div >
										<h4>Local: {{local| currency:'&#8358;'}}</h4>
									</div>
									<div>
										<h4>Total: {{total| currency:'£'}}</h4>
									</div>
								</div>
							</div>
						</div>
						<p></p>
						  <div class="row">
							  <div class="row" ng-controller="loginCtrl" ng-cloak>
								<div class="col-md-11  well well-md">
										<form  ng-submit="submit()" name="log" >
											<h4 class="text-center" ng-controller="myCtrl"> <strong>{{busName}}</h4></strong>
										  <hr>
										  <p> <strong class="text-center">Sign in using Social network</strong>
											<br/>
										  <div class="row">
											  <div class="col-md-6">
												<a href="" class="btn btn-primary btn-block" ng-click="facebookLogin()">
												   <i class="fa fa-facebook fa-2x" aria-hidden="true"></i>
												  Login with facebook</a>
											  </div>
											  <div class="col-md-6">
												<a href="" class="btn btn-danger btn-block" ng-click="googleLogin()">
												<i class="fa fa-google fa-2x" aria-hidden="true"></i>
												Login with Google</a>
											  </div>
										  </div>
										  <hr>  
										  <div class="row" id="message">
											<div class="col-md-12 text-center " style="background:#ffbf00 !important;color:#ffffff;padding:10px;">
											  <strong>{{message}}</strong>
											</div>
										  </div>
										  <p></p>
										  <div class="row"  id = "status">
											<div class="col-md-12 text-center " style="background:#ffbf00 !important;padding:10px;">
											  <strong>You have got <span class="text-danger">{{daysleft}}</span> days left. Your susbscription is comming to an end. Please click on the link below to make payment. To avoid distruption of your service</strong><br>
											  <a href="users/admin/index.php" class="btn btn-success">Continue</a> 

											  <a href="payment.php" class="btn btn-danger">Make Payment</a>
											</div>
										  </div>
										  <p> <strong>Sign in using a registered account</strong> </p>
										  <div class="form-group">
												<input type="text" class="form-control" name="email" value="" placeholder="Username or Email" ng-model="email" id="email" required>
										  </div>

										  <div class="form-group">
											  <input type="password" class="form-control" name="password" value="" placeholder="Password" ng-model="password" id="password" required>
											</div>
											 
											  
											<div class="row">
											  <div class="col-md-6">
												  <label>
													<input type="checkbox" name="remember_me" id="remember_me">
													Keep me sign in
												  </label>
											  </div>

												 <div class="col-md-6 form-group">
												  <input class="btn btn-primary btn-block" type="submit" name="Login" value="Login" ng-click="submit()">
												</div>
										  </div>

										</form>
										
										<div class="row">
											  <div class="col-md-6 text-center">
												   
													<a href="controllers/register.php" class=" btn-block">
													  <i class="fa fa-user-plus fa-2x" aria-hidden="true"></i>
															  Register
													</a>
													
												</div>
												<div class="col-md-6 text-center">    
													<a href="controllers/forgot_password.php" class=" btn-block">
													  <i class="fa fa-key fa-2x" aria-hidden="true"></i>
															  Password Reset
													</a>
													
												</div>
											</div>
									  </div>
									 </div>
								</div>
				</div>
				</div>
			</div>
 
  </section>

  <footer>
      <p class="text-center"><a href="http://www.danielogunkoya.com"></a>Design And Developed by Daniel A ogunkoya</a>. All right reserved &copy; 2018</p>
  </footer>

</body>
</html>
	
	<script src="public/js/jquery-3.1.1.min.js"></script>
	<script src="public/angular/angular.js"></script>
	<script src="public/angular/ng-facebook/ngFacebook.js"></script>
	<script src="public/bower_components/ng-google-signin/dist/ng-google-signin.js"></script>
	<!--<script src="js/angular-toastr.js"></script> -->

	<script src="public/app/app.js"></script>
  <script src="public/app/app.payment.service.js"></script>
	<script src="public/app/app.controller.js"></script>
	<script src="public/app/app.coverter.controller.js"></script>
	<script src="public/app/app.login.controller.js"></script>
	
  <script src="public/app/app.payment.controller.js"></script>