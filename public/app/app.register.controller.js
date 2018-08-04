var app = angular.module('registerApp', ['myAppService']);

app.controller('registerCtrl',['$scope','$rootScope','$http','serv','$location','$window',  function($scope,$rootScope,$http,serv,$location,$window) {


//user register
	$scope.register=function(){
		var data={
			'fname':$scope.fname,
			'lname':$scope.lname,
			'mname':"",
			'phone':$scope.phone,
			'email':$scope.email,
			'password':$scope.password,
			'cpassword':$scope.password,
			'dob':"",
			'postcode':$scope.postcode,
			'company':"",
			'line1':$scope.address,
			'line2':"",
			'line3':"",
			'town':"",
			'county':"",
			'country':""
		};
		
		
			serv.register2(data).then(function(response){
				console.log(response);
				var status=response.data.status;
				var type=response.data.type;
				console.log('type'+ type)
		if(type=='success')
		{
			$scope.message="successfully posted,Please activate with register email:" + $scope.email;
				$('#fname').val('');
				$('#lname').val('');
				$('#mname').val('');
				$('#email').val('');
				$('#password').val('');
				$('#cpassword').val('');
				$('#dob').val('');
				$('#phone').val('');
				$('#postcode').val('');
				$('#line1').val('');
				$('#line2').val('');
				$('#line3').val('');
				$('#town').val('');
				$('#county').val('');
				$('#country').val('');
			}
			else{
				$scope.message=response.data.details;
			}

			}); 
		
	}


	
	

}]);
