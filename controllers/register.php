<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="shortcut icon" href="img_fvr.php" type="image/jpeg" />
   <link rel="stylesheet" href="users/templates/css/bootstrap.css" type="text/css" />
   <link rel="stylesheet" href="users/templates/css/login.css" type="text/css" />
   <link rel="stylesheet" href="users/templates/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" />
  
<title> Login Form</title>
  
</head>
<body ng-app="registerApp" ng-controller="registerCtrl" ng-cloak>


  <section id="main">
     <h3 class="text-center"></h3>

  <div class="row">
    <div class="col-md-12 text-center">
    </div>
  </div>


  
    <div class="login">
    	
      <div class="row" ng-controller="registerCtrl">
      	<div class="col-md-6 col-md-offset-3 well well-md">
          <div class="row" >
            <div class="col-md-7 col-md-offset-3 well well-md">
                    <form  ng-submit="submit()" name="log" >
                        <h4 class="text-center" ><a href="index.php"> </a></h4>
                      
                       
                      <p> <h3>New Account</h3> </p>
                      <div class="form-group">
                            <input type="text" class="form-control" name="fname" ng-model="fname" value="" placeholder="First Names" ng-model="fname" id="fname" required>
                      </div>

                       <div class="form-group">
                            <input type="text" class="form-control" name="lname" ng-model="lname" value="" placeholder="Last Names" ng-model="lname" id="lname" required>
                      </div>

                       <div class="form-group">
                          <input type="text" class="form-control" name="email" ng-model="email" value="" placeholder="Email Address" ng-model="email" id="email" required>
                        </div>

                      <div class="form-group">
                          <input type="password" class="form-control" name="password" ng-model="password" value="" placeholder="Password" ng-model="password" id="password" required>
                        </div>


                         <div class="form-group">
                          <input type="text" class="form-control" name="phone" ng-model="phone" value="" placeholder="Phone Number" ng-model="phone" id="phone" required>
                        </div>

                         <div class="form-group">
                          <input type="text" class="form-control" name="postcode" ng-model="postcode" value="" placeholder="Post Code" ng-model="postcode" id="postcode" required>
                        </div>

                         <div class="form-group">
                          <input type="text" class="form-control" name="address" ng-model="address" value="" placeholder="Address" ng-model="address" id="address" required>
                        </div>
                         
                          
                        <div class="row">
                          <div class="col-md-6">
                              
                          </div>

                             <div class="col-md-6 form-group">
                              <input class="btn btn-primary btn-block" type="submit" name="submit" value="Submit" ng-click="register()">
                            </div>
                      </div>

                    </form>
                  </div>

                  <div class="row">
		                      <div class="col-md-6 text-center">
				                    <p>Forgot Password?  
		                          <a href="forgot_password.php" class="btn btn-warning">
				                      <i class="fa fa-key fa-2x" aria-hidden="true"></i>
				                              Password Reset
				                    </a></p>
				                </div>
				                <div class="col-md-6 text-center">
				                    <p>Login  
		                          <a href="../index.php" class="btn btn-primary">
				                      <i class="fa fa-sign-in fa-2x" aria-hidden="true"></i>
				                              Login
				                    </a></p>
		                      </div>
                      </div>
                  </div>
      			 </div>
      		</div>
    	</div>
     
    </div>
 
  </section>

  <footer>
      <p class="text-center">Design And Developed by computing24x7. All right reserved &copy; 2018</p>
  </footer>

</body>
</html>
	
	<script src="../public/js/jquery-3.1.1.min.js"></script>
	<script src="../public/angular/angular.js"></script>
	<script src="../public/angular/ng-facebook/ngFacebook.js"></script>
	<script src="../public/bower_components/ng-google-signin/dist/ng-google-signin.js"></script>
	<!--<script src="js/angular-toastr.js"></script> -->

	<script src="../public/app/app.service.js"></script>
	<script src="../public/app/app.register.controller.js"></script>
	