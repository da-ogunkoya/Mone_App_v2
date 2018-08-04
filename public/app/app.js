var app = angular.module('myApp', ['ngFacebook','google-signin','payService',
					'controllerApp','exchangeApp','loginApp','paymentApp']);


app.config(['GoogleSigninProvider', function(GoogleSigninProvider) {
     GoogleSigninProvider.init({
        client_id:'342367869552-89ds4vfpbvq74e5t0kn70vug4c3g99vp.apps.googleusercontent.com',
     });
}]);
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
.config( function( $facebookProvider) {
  $facebookProvider.setAppId('371964139982378');
  $facebookProvider.setPermissions("email,public_profile");
   $facebookProvider.getPermissions("email,public_profile");
})

.run(function($rootScope){
	(function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
});

