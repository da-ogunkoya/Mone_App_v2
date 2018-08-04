<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="shortcut icon" href="img_fvr.php" type="image/jpeg" />
   <link rel="stylesheet" href="users/templates/css/bootstrap.css" type="text/css" />
   <link rel="stylesheet" href="users/templates/css/login.css" type="text/css" />
   <link rel="stylesheet" href="users/templates/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" />
 
  
<title> Payment</title>
  
</head>
<body ng-app="myApp"  ng-cloak  >


  <section id="main">
     <h3 class="text-center"></h3>

  <div class="row">
    <div class="col-md-12 text-center">
    </div>
  </div>


  
    <div class="login" >
    	
      

                  <div class="row">
                      <div class="col-md-7 col-md-offset-2 text-center">

                      
                         <h4 class="text-center"  ><a href="index.php" ng-controller="myCtrl"><strong id = "bname"> {{busName}}</strong></a></h4>
                      <hr>  
                      <div class="row" id="message">
                        <div class="col-md-12 text-center " style="background:#ffbf00 !important;color:#ffffff;padding:10px;">
                          <strong>{{message}}</strong>
                        
                      </div>
                      </div>
                          <div class="panel panel-default">


                          <div class="panel panel-default"  ng-controller="servicePayment">
                            <div class="panel-heading">
                              <h3>Payment of <span class="text-danger">£{{amountDue}}</span></h3>
                              <input ng-model="busname"  id="busname" type="hidden">
                            </div>
                            <div class="panel-body">
                              
                                <h4 class="text-danger text-left"><strong>Bank Transfer: </strong></h4>
                                
                              <p></p>
                                  <form>

                                      <div class="form-group">
                                          <label><span class="text-danger">*</span></span> Bank Name</label></label>
                                          <input type = "text" class="form-control" id = "name" ng-model="name" required>
                                        </div>


                                      <div class="form-group">
                                          <label><span class="text-danger">*</span></span> Bank Reference</label>
                                          <input type = "text" class="form-control" ng-model="reference" id = "reference" required>
                                        </div>

                                        <div class="form-group">
                                          <label><span class="text-danger">*</span></span> Amount Paid</label>
                                          <input id ="amountPaid" ng-model="amountPaid" type = "text"  class="form-control text-center" required>
                                      </div>

                                       <div class="form-group">
                                          <button id="submit" class="btn btn-success btn-block" ng-click="submit()">Submit</button>
                                      </div>
                                      <hr> 
                                       <h4 class="text-danger text-left"><strong>Other Payment Options </strong></h4>
                                      <a ng-click = "paypalCheckout()" href= "" class="btn btn-danger btn-block"><i class="fab fa-paypal fa-5x"></i> Paypal</a>

                                       <a ng-click = "googleCheckout()"  href= "" class="btn btn-default btn-block"><i class="fab fa-google-wallet fa-5x"></i> Google Wallet</a>


                                    </form>

                          </div>
                            </div>
                          </div>                                                              
                          <hr>

                        
                          
                          
  		                    
                      </div>
                  </div>
      			 </div>
      		
    </div>
 
  </section>
<!--
  <footer style = "position:fixed; left:0;bottom:00px;">
      <p class="text-center">Design And Developed 3by computing24x7. All right reserved &copy; 2018</p>
  </footer>
-->

</body>
</html>
	 <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="angular/angular.js"></script>
	<script src="angular/ng-facebook/ngFacebook.js"></script>
	<script src="bower_components/ng-google-signin/dist/ng-google-signin.js"></script>
	<!--<script src="js/angular-toastr.js"></script> -->
   

	
   
	<script src="app/app.controller.js"></script>
	<script src="app/app.coverter.controller.js"></script>
	<script src="app/app.login.controller.js"></script>
	<script src="app/app.register.controller.js"></script>
  <script src="app/app.payment.controller.js"></script>
<script src="app/app.payment.service.js"></script>
   <script src="app/payment.js"></script>
   
  <script src="app/app.js"></script>
