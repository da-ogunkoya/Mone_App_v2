var app = angular.module('paymentApp', []);

app.controller('servicePayment',['$scope','$rootScope','$http','serv','$location','$window', '$facebook','GoogleSignin','paymentService', function($scope,$rootScope,$http,serv,$location,$window,facebook,GoogleSignin,paymentService) {
	
	
	 
	$http.get('services/subscription').then(function(response){
		$scope.amountDue =  response.data.amount_due
		$scope.amountPaid =  response.data.amount_due
	})
	//request business info
	$http.get('services/info').then(function(response){
		$scope.busname = response.data.name1;
	});
	
//paypal payment	
	$scope.paypalCheckout = function(){
		$http.get('services/subscription').then(function(response){
			paymentService.services.checkout('PayPal',parseInt(response.data.amount_due))
			sendPayment($scope.name,'paypal-ref',$scope.amountDue,'paypal')
		})
			;	
	}
//googgle wallet payment
	$scope.googleCheckout = function(){
		console.log('google pay clicked')
		paymentService.services.checkout('Google');	
		sendPayment($scope.name,'google-ref',$scope.amountDue,'Google-wallet')
	}

//bank transfer
	$scope.submit= function(){
		
			if($scope.amountPaid == null || $scope.name == null){
				$('#message').show()
					$scope.message= "Please fill in all essental fields" ;
			}
			else{
					sendPayment($scope.name,$scope.reference,$scope.amountPaid,'transfer')
			}
			
	}

	
//send payment method
	  function sendPayment(name,reference,amountPaid,transfer){
				data = {
							name:name,
							company:$scope.busname,
							reference:reference,
							paid:amountPaid,
							amountDue:$scope.amountDue,
							type:transfer
						}
				paymentService.paysubscription(data).then(function(response){
					console.log(response)
				})
				

				console.log(data)
			//clear	
				$scope.name = ""
				$scope.reference=""
				$scope.amountDue=""
	}

	
	

}]);
