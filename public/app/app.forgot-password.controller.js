var app = angular.module('forgot-password', ['myAppService']);

app.controller('myCtrl',['$scope','$rootScope','$http','serv','$location','$window',  function($scope,$rootScope,$http,serv,$location,$window) {
	$scope.isLoggedIn = false;

	

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
	$http.get('../services/info').then(function(response){
		$rootScope.busName = response.data.name1;
	});


	
	

}]);
