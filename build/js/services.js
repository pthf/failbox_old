(function(){

	angular.module('failboxStore.services', [])

		.factory('failboxService', ['$http', '$q', '$filter', function ($http, $q, $filter) {

			function sliderHome(){
				var deferred = $q.defer();

				$http.get('./php/bannersHome.php')
					.success(function (data) {
						deferred.resolve(data);
					});

				return deferred.promise;
			}

			function new_products(){
				var deferred = $q.defer();

				$http.get('./php/new_products.php')
					.success(function (data) {
						deferred.resolve(data);
					});

				return deferred.promise;
			}

			function feactured_products(){
				var deferred = $q.defer();

				$http.get('./php/new_products_featured.php')
					.success(function (data) {
						deferred.resolve(data);
					});

				return deferred.promise;
			}

			function all(){
				var deferred = $q.defer();

				$http.get('./php/items.php')
					.success(function (data) {
			      deferred.resolve(data);
			    });

			    return deferred.promise;
			}

			function byItem(id){
				var id = id;
				var deferred = $q.defer();

				all().then(function (data) {

		        	var results = data.filter(function(item){
		        		return item.id === id;
		        	});

		        	if(results.length > 0 ){
		        		deferred.resolve(results[0]);
		        	} else {
		        		deferred.reject();
		        	}

		        });

		        return deferred.promise;
			}

			function productFilteredThree(category, subcategory, brand){
				var deferred = $q.defer();
				$http.get('./php/products_filters.php?nameCategory='+category+'&nameSubcategory='+subcategory+'&nameBrand='+brand)
					.success(function (data) {
						deferred.resolve(data);
					});
				return deferred.promise;
			}

			function productFilteredTwo(category, subcategory){
				var deferred = $q.defer();
				$http.get('./php/products_filters.php?nameCategory='+category+'&nameSubcategory='+subcategory)
					.success(function (data) {
						deferred.resolve(data);
					});
				return deferred.promise;
			}

			function productFilteredOne(category){
				var deferred = $q.defer();
				$http.get('./php/products_filters.php?nameCategory='+category)
					.success(function (data) {
						deferred.resolve(data);
					});
				return deferred.promise;
			}

			function productFiltered(){
				var deferred = $q.defer();
				$http.get('./php/products_filters.php')
					.success(function (data) {
						deferred.resolve(data);
					});
				return deferred.promise;
			}

			function showMenuCategories(){
				var deferred = $q.defer();
				$http.get('./php/menu.php')
					.success(function (data) {
						deferred.resolve(data);
					});
				return deferred.promise;
			}

			return {
				sliderHome: sliderHome,
				new_products: new_products,
				feactured_products: feactured_products,
				byItem:byItem,
				productFilteredThree: productFilteredThree,
				productFilteredTwo: productFilteredTwo,
				productFilteredOne: productFilteredOne,
				productFiltered: productFiltered,
				showMenuCategories: showMenuCategories
			}

		}]);

})();
