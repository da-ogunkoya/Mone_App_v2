<?php echo BASE_URI;?>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="shortcut icon" href="img_fvr.php" type="image/jpeg" />
   <link rel="stylesheet" href="<?php echo BASE_URI; ?>templates/css/bootstrap.css" type="text/css" />
   <link rel="stylesheet" href="<?php echo BASE_URI; ?>templates/css/login.css" type="text/css" />
   <link rel="stylesheet" href="<?php echo BASE_URI; ?>templates/css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" />
  
<title> Login Form|<?php if (isset($name1)){ echo $name1;} ?></title>
  
</head>
<body>


  <section id="main">
     <h3 class="text-center"><?php if (isset($name1)){ echo $name1;} ?></h3>
  

  <div class="row">
    <div class="col-md-12 text-center">

      <?php echo displayMessage(); ?>

    </div>
  </div>


  
    <div class="login">
      <div class="row">
      	<div class="col-md-6 col-md-offset-3 well well-md">
      		<!--<h3><a class="btn btn-primary" href="APP/agent_login.php" style="color:#fffff ;">Login To System 2</a></h3>-->
          <div class="row">
            <div class="col-md-6 col-md-offset-3 well well-md">
                    <form method="post" action="">
                        <h3>Sign In</h3>
                      <hr>
                      <p> <strong>Sign in using Social network</strong>
                        <br/>
                      <div class="row">
                          <div class="col-md-6">
                            <a href="" class="btn btn-primary btn-block">
                               <i class="fa fa-facebook fa-2x" aria-hidden="true"></i>
                              Login with facebook</a>
                          </div>
                          <div class="col-md-6">
                            <a href="" class="btn btn-danger btn-block">
                            <i class="fa fa-google fa-2x" aria-hidden="true"></i>
                            Login with Google</a>
                          </div>
                      </div>
                      <hr>  
                      <p> <strong>Sign in using a registered account</strong> </p>
                      <div class="form-group">
                            <input type="text" class="form-control" name="email" value="" placeholder="Username or Email">
                      </div>

                      <div class="form-group">
                          <input type="password" class="form-control" name="password" value="" placeholder="Password">
                        </div>
                         
                          
                        <div class="row">
                          <div class="col-md-6">
                              <label>
                                <input type="checkbox" name="remember_me" id="remember_me">
                                Keep me sign in
                              </label>
                          </div>

                             <div class="col-md-6 form-group">
                              <input class="btn btn-primary btn-block" type="submit" name="Login" value="Login">
                            </div>
                      </div>

                    </form>
                  </div>

                  <div class="row">
                      <div class="col-md-12 text-center">
                          <p>Don't have an account? <strong class="text-primary">Register</strong></p>
                      </div>
                  </div>
      			 </div>
      		</div>
    	</div>
     
    </div>
 
  </section>

  <footer>
      <p class="text-center">Design And Developed by computing24x7. All right reserved &copy; 2017</p>
  </footer>

</body>
</html>