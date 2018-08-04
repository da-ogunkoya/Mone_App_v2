<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="shortcut icon" href="img_fvr.php" type="image/jpeg" />
   <link rel="stylesheet" href="users/templates/css/bootstrap.css" type="text/css" />
   <link rel="stylesheet" href="users/templates/css/login.css" type="text/css" />
   <link rel="stylesheet" href="users/templates/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" />
  
<title>  Password Reset</title>
  
</head>
<body ng-app="myApp" ng-controller="myCtrl" ng-cloak>


  <section id="main">
     <h3 class="text-center"></h3>

  <div class="row">
    <div class="col-md-12 text-center">
    </div>
  </div>


  
    <div class="login" ng-controller="myCtrl">
    	
      <div class="row">
          	<div class="col-md-6 col-md-offset-3 well well-md">
              <div class="row">
                    <div class="col-md-7 col-md-offset-3 well well-md">
                            <form  ng-submit="submit()" name="log" >
                                <h3 class="text-center" > {{busName}}</h3>
                              <p>
                                <h4 class="text-center"> Password Reset</h4>
                                <hr>
                              <div class="form-group">
                                    <input type="password" class="form-control btn-block" name="email" value="" placeholder="Password " ng-model="password" id="email" required>
                              </div>

                               <div class="form-group">
                                    <input type="password" class="form-control btn-block" name="email" value="" placeholder="Confirm Password" ng-model="cpassword" id="email" required>
                              </div>

                            </form>
                      </div>
                    </div>
                  </div>
              </div>

                  <div class="row">
                      <div class="col-md-12 text-center">
                          
                          <a href="#" class="btn btn-success" ng-click = "newPassword()">
  		                      <i class="fa fa-user fa-2x" aria-hidden="true"></i>
  		                              Submit Email
  		                    </a>

                          <p>
  		                    
  		                   <a href="index.php" class="btn btn-warning">
  		                      <i class="fa fa-sign-in fa-2x" aria-hidden="true"></i>
  		                              Login in
  		                    </a>
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
	
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="angular/angular.js"></script>
	<script src="angular/ng-facebook/ngFacebook.js"></script>
	<script src="bower_components/ng-google-signin/dist/ng-google-signin.js"></script>
	<!--<script src="js/angular-toastr.js"></script> -->

	<script src="app/app.js"></script>
	<script src="app/app.controller.js"></script>
	<script src="app/app.coverter.controller.js"></script>
	<script src="app/app.login.controller.js"></script>
	<script src="app/app.register.controller.js"></script>