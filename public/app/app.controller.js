var app = angular.module('controllerApp', []);

app.controller('myCtrl',['$scope','$rootScope','$http','serv','$location','$window', '$facebook','GoogleSignin', function($scope,$rootScope,$http,serv,$location,$window,facebook,GoogleSignin) {
	$scope.isLoggedIn = false;

	var email = 
		

//set new password
		$scope.newPassword = ()=>{
		password = $scope.password
		cpassword = $scope.cpassword
		email = $location.absUrl().split('=')[1]
		console.log('email= ' + email)
		
		$http({
			'method':'POST',
			'url':'services/new_password',
			'data':{
				email:email,
				password:$scope.password,
				cpassword:$scope.cpassword,
				
			}
		}).then(function(response){
			console.log(response)
			//window.location='users/admin/index.php';
		})
		window.location='index.php';
	}
//send email password reset
	$scope.sendPasswordReset = ()=>{
		email = $scope.email
		$http({
			'method':'POST',
			'url':'services/forgot_password',
			'data':{
				email:email
			}
		}).then(function(response){
			console.log(response)
			
		})

		window.location='index.php';
	}

//request business info
	$http.get('services/info').then(function(response){
		$rootScope.busName = response.data.name1;
	});
//request todays rate
	serv.getRate().then(function(response){
		console.log(response);
		$rootScope.rate=response.data.rate;
		
	});

	
	

}]);
