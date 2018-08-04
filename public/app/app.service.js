var app = angular.module('myAppService', []);


app.factory('serv',['$http', function($http){
	var obj={};
	
	
	obj.getRate=function(){
		return $http.get('services/rate');
	}

	obj.busInfo=function(){
		return $http.get('services/info');
	}
	
	obj.getCom=function(val){
		return $http.get('services/commission?val=' + val);
	}

	obj.logIn=function(email,password){
		return $http.get('services/login?'+ 'email=' + email + '&password=' + password	);
	}

	 obj.logIn2=function(user){
		return $http({
			'method':'POST',
			'url':'services/login',
			'data':user
		});
	}

	obj.register2=function(user){
		return $http({
			'method':'POST',
			'url':'../services/register',
			'data':user
		});
	}
	return obj;
	
}])


