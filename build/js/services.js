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

			function sliderCart(){
				var deferred = $q.defer();

				$http.get('./data/itemsSliderCart.json')
					.success(function (data) {
						deferred.resolve(data);
					});
				return deferred.promise;
			}

			return {
				sliderHome: sliderHome,
				sliderCart: sliderCart
			}

		}]);

})();