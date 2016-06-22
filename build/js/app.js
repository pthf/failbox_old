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
			.when('/productos/', {
				templateUrl: 'views/productos.html',
				controller: 'homeSliderController'
			})
			.when('/productos/:category/:subcategory/:brand', {
				templateUrl: 'views/productos.html',
				controller: 'homeSliderController'
			})
			.when('/productos/:category/:subcategory', {
				templateUrl: 'views/productos.html',
				controller: 'homeSliderController'
			})
			.when('/productos/:category', {
				templateUrl: 'views/productos.html',
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
