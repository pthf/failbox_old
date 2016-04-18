(function (){

	var app = angular.module('failboxStore', [
    	'ngRoute',
    	'failboxStore.controllers',
    	'failboxStore.services',
    	'failboxStore.directives'
  	]);

	app.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
		$routeProvider 
			.when('/', {
				templateUrl: 'views/home.html',
				controller: 'homeSliderController'
			})
			.otherwise({
				redirectTo: '/'
			});
		$locationProvider.html5Mode(true);
	}]);

})();