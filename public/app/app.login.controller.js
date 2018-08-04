var app = angular.module('loginApp', []);

app.controller('loginCtrl',['$scope','$rootScope','$http','serv','$location','$window', '$facebook','GoogleSignin', function($scope,$rootScope,$http,serv,$location,$window,$facebook,GoogleSignin) {
	$scope.isLoggedIn = false;
	//$scope.status= true ;
//google login

	$scope.googleLogin=function(){
		 GoogleSignin.signIn().then(function (user) {
            console.log(user);

            var id = user.El;
			var email = user.w3.U3;
			console.log('email='+ email);
			var name = user.w3.wea + ' ' + user.w3.ofa;
			var data={
						email:email,
						name:name,
						id:id,
						password:'social'
					}
					processLogIn(data);
        }, function (err) {
            console.log(err);
        });
	}
//facebook login
	$scope.facebookLogin=function(){
	$facebook.login().then(function(){
				$scope.isLoggedIn = true;
				refresh();
			});
	console.log('logged in');
	}
		function refresh(){
			
			$facebook.api('/me?fields=id,name,email').then(function(response){
				console.log("Welcome "+ response.name);
				console.log(response.email);
					var email=response.email;
					var name=response.name;
					var id=response.id;
					var data={
							email:email,
							name:name,
							id:id,
							password:'social'
				}
					processLogIn(data);

			},
			function(err){
				$scope.welcomeMsg = "Please Log In";
			});
		}




//login
$scope.submit=function(){
			var email=$scope.email;
			var password=$scope.password;

			var data={
				email:email,
				password:password
			}
		processLogIn(data);
		}

		function processLogIn(data){
			serv.logIn2(data).then(function(data){
								console.log(data.data);
							status=data.data.status;
							$type=data.data.type;
							$level=data.data.level;
							daysLeft=data.data.daysleft;


						if(status=='success'){
						//subscription Validation
							if(parseInt(daysLeft) > 1 ){

									if($type=='customer'){
										window.location='controllers/users/index.php';
									}
									else{
										if($level==0){
											window.location='controllers/users/index.php';
										}
										else{
											if(($level==1) || ($level==2)|| ($level==3)|| ($level==4)){
												if(daysLeft < 66){
													
													$('#status').show()
													$scope.daysleft =daysLeft
												}

												else{
													window.location='controllers/users/admin/index.php';
												}
												
											}
											else{
													window.location='controllers/users/index.php';
											}
										}
									}
								}else{	
										$('#message').show()
										$scope.message= "System Maintainance is needed,Please Contact admin" ;
								}
						}
						else{
							console.log('login error=' + data.data.details);
							$('#message').show()
							$scope.message= data.data.details ;
						}
				});	
			}


	
	

}]);
