(function (){

	var app = angular.module('failboxStore', [
    	'ngRoute',
    	'failboxStore.controllers',
    	'failboxStore.services',
    	'failboxStore.directives'
  	]);

	app.config(['$routeProvider', function ($routeProvider) {
		
		$routeProvider 
			.when('/', {
				templateUrl: 'views/home.html',
				controller: 'homeSliderController'
			})
			.when('/articulo/:id', {
				templateUrl: 'views/articulo.html',
				controller: 'itemController'
			})
			.otherwise({
				redirectTo: '/'
			});	
		
	}]);

})();