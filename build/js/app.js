(function (){

	var app = angular.module('failboxStore', [
    	'ngRoute',
    	'failboxStore.controllers',
    	'failboxStore.directives'
    	//'failboxStore.filters',
    	//'failboxStore.services'
  	]);

	app.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {
		$routeProvider 
			.when('/', {
				templateUrl: 'views/home.html'//,
       			//controller: 'FailboxController'
			})
			.otherwise({
				redirectTo: '/'
			});

		$locationProvider.html5Mode(true);
		
	}]);

})();