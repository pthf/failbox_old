(function(){

	angular.module('failboxStore.services', [])

		.factory('failboxService', ['$http', '$q', '$filter', function ($http, $q, $filter) {

			function sliderHome(){
				var deferred = $q.defer();

				$http.get('./data/bannersHome.json')
					.success(function (data) {
						deferred.resolve(data);
					});
				return deferred.promise;
			}

			function new_products(){
				var deferred = $q.defer();

				$http.get('./data/new_products.json')
					.success(function (data) {
						deferred.resolve(data);
					});
				return deferred.promise;
			}

			function feactured_products(){
				var deferred = $q.defer();

				$http.get('./data/feactured_products.json')
					.success(function (data) {
						deferred.resolve(data);
					});
				return deferred.promise;
			}

			return {
				sliderHome: sliderHome,
				new_products: new_products,
				feactured_products: feactured_products
			}

		}]);

})();