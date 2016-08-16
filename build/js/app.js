(function (){

	var app = angular.module('failboxStore', [
    	'ngRoute',
    	'failboxStore.controllers',
    	'failboxStore.services',
    	'failboxStore.directives',
			'failboxStore.filters'
  	]);

	app.config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {

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
			.when('/articulo/:url', {
				templateUrl: 'views/articulo.html',
				controller: 'itemController'
			})
			.when('/contacto', {
				templateUrl: 'views/contacto.html',
				controller: 'homeSliderController'
			})
			.when('/faq', {
				templateUrl: 'views/faq.html',
				controller: 'homeSliderController'
			})
			.when('/aviso-de-privacidad', {
				templateUrl: 'views/privacidad.html',
				controller: 'homeSliderController'
			})
			.when('/micarrito', {
				templateUrl: 'views/carrito/micarrito.html',
				controller: 'carrito'
			})
			.when('/datos-envio', {
				templateUrl: 'views/carrito/datosenvio.html',
				controller: ''
			})
			.when('/resumen-compra', {
				templateUrl: 'views/carrito/resumencompra.html',
				controller: ''
			})
			.otherwise({
				redirectTo: '/'
			});

			$locationProvider.html5Mode(true);

	}]);

	app.run(['$rootScope', function($rootScope){
		$rootScope.pages = 1;
	}])

})();
