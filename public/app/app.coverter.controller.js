var app = angular.module('exchangeApp', []);

app.controller('exchangeCtrl',['$scope','$rootScope','$http','serv','$location','$window', '$facebook','GoogleSignin', function($scope,$rootScope,$http,serv,$location,$window,facebook,GoogleSignin) {
	$scope.isLoggedIn = false;


// Rate Coversion -pounds	/commision
	$scope.process=function(send){
		serv.getCom(send).then(function(response){
			
			var com=parseFloat(response.data.value);
			if (com < 1){				//test if commission is less than 1 for % of amount
				$scope.amount=send;
				com=parseFloat(send) * parseFloat(com);
				$scope.total=parseFloat(send)  + parseFloat(com);
				$scope.local=parseInt(send) * parseInt($rootScope.rate);
				$scope.sendn= (parseInt(send) * parseInt($rootScope.rate)).toFixed(2);
				$scope.commission=com;
			}
				else{
				$scope.amount=send;
				$scope.total=parseFloat(send)  + parseFloat(com);
				$scope.local=parseInt(send) * parseInt($rootScope.rate);
				$scope.sendn=(parseInt(send) * parseInt($rootScope.rate)).toFixed(2);
				$scope.commission=response.data.value;
			}
		});
	}
	
// in naira 
		$scope.processn=function(sendn){
			var send= parseFloat(sendn)/ parseFloat($rootScope.rate);
		serv.getCom(send).then(function(response){
			var com=parseFloat(response.data.value);
			if (com < 1){	
				$scope.amount=parseInt(send);
				com=parseFloat(send) * parseFloat(com);
				$scope.total=parseFloat(send)  + parseFloat(com);
				$scope.local=parseInt(send) * parseInt($rootScope.rate);
				$scope.send= parseFloat(send).toFixed(2);
				$scope.commission=com;
			}
			
			else{
				$scope.amount=parseInt(send);
				$scope.send= parseFloat(send).toFixed(2);
				$scope.total=parseFloat(send)  + parseFloat(com);
				$scope.local=parseInt(sendn);
				$scope.commission=response.data.value;
			}
			
		});
	}
	
	

}]);
