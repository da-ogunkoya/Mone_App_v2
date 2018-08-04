angular.module('payService',[])
.factory('paymentService', function($http,$rootScope){
	
console.log('service')
	var Payment = new subscriberPayment("mxlimitesStore");
	    // enable PayPal checkout
    // note: the second parameter identifies the merchant; in order to use the 
    // shopping cart with PayPal, you have to create a merchant account with 
    // PayPal. You can do that here:
    // https://www.paypal.com/webapps/mpp/merchant
    Payment.addCheckoutParameters("PayPal", "danielbillion@gmail.com");

    // enable Google Wallet checkout
    // note: the second parameter identifies the merchant; in order to use the 
    // shopping cart with Google Wallet, you have to create a merchant account with 
    // Google. You can do that here:
    // https://developers.google.com/commerce/wallet/digital/training/getting-started/merchant-setup
    Payment.addCheckoutParameters("Google", "500640663394527",
        {
            ship_method_name_1: "UPS Next Day Air",
            ship_method_price_1: "20.00",
            ship_method_currency_1: "USD",
            ship_method_name_2: "UPS Ground",
            ship_method_price_2: "15.00",
            ship_method_currency_2: "USD"
        }
    );


	return{
		services:Payment,
		paysubscription: function(data){
			return $http({
					'method': 'POST',
					'url': 'services/paysubscription',
					data:data
					})
		},
	};
});