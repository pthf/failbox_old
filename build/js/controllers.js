(function(){

	angular.module('failboxStore.controllers', [])

		.controller('topMenuController', ['$scope', function($scope){
			$scope.menuProductos = {
				cat : {
					'Electronica' : {
						'Televisiones': {
							'MARCA1': 1,
							'MARCA2': 2,
							'MARCA3': 3,
							'MARCA4': 4,
							'MARCA5': 5
						},
						'Audio y Sonido': {
							'MARCA6': 6,
							'MARCA7': 7
						},
						'Home Theater': {
							'MARCA8': 8,
							'MARCA9': 9,
							'MARCA5': 5,
							'MARCA3': 3
						},
						'Videojuegos': {
							'MARCA9': 9,
							'MARCA5': 5
						},
						'Celulares': {
							'MARCA1': 1,
							'MARCA3': 3
						}
					},
					'Muebles' : {
						'Salas': {
							'MARCA7': 7,
							'MARCA8': 8
						},
						'Mesas': {
							'MARCA1': 1
						},
						'Camas': {
							'MARCA2': 2,
							'MARCA3': 3,
							'MARCA4': 4,
						}
					}
				}
			};

			$scope.openCategory = function(categoryName){
					$('ul.subcategoryList').slideUp();
					$('span[name="'+categoryName+'"]').siblings('ul.subcategoryList').slideDown();
			};

			$scope.openSubCategory = function(categoryName){
					$('ul.brandList').slideUp();
					$('span[name="'+categoryName+'"]').siblings('ul.brandList').slideDown();


			};

		}])

		.controller('tabShowMenuTopController', function(){
			this.menuProductos = false;
			this.menuCuenta = false;
			this.menuBrand = 0;
			this.tab_selected = 0;

			this.selectBrand = function(brandSelect){
					this.menuBrand = brandSelect;
			};

			this.selectTab = function(tab_selected){
				this.tab_selected = tab_selected;
			};

			this.openMenu = function(){
				this.menuProductos = !this.menuProductos;
			};

			this.openCuenta = function(){
				this.menuCuenta = !this.menuCuenta;
			};

			this.closeMenuRestart = function(){
				this.menuProductos = false;
				this.menuCuenta = false;
				this.menuBrand = 0;
				this.tab_selected = 0;
			};

		})

		.controller('homeSliderController', ['$scope', 'failboxService', function($scope, failboxService){
			$scope.loadingData = false;
			failboxService.sliderHome().then(function(data){
				$scope.bannerMenu = data;
				$scope.loadingData = true;
			});
		}])

		.controller('sliderNewProductsController', ['$scope', 'failboxService', function($scope, failboxService){
			$scope.loadingData = false;
			failboxService.new_products().then(function(data){
				$scope.itemsCart = data;
				$scope.loadingData = true;
			});
		}])

		.controller('sliderFeacturedProductsController', ['$scope', 'failboxService', function($scope, failboxService){
			$scope.loadingData = false;
			failboxService.feactured_products().then(function(data){
				$scope.itemsCart = data;
				$scope.loadingData = true;
			});
		}])

		.controller('showProdutsByFilters', ['$scope', '$routeParams', 'failboxService', function($scope, $routeParams, failboxService){
			var category = $routeParams.category;
			var subcategory = $routeParams.subcategory;
			var brand = $routeParams.brand;

			if(category != null && subcategory != null && brand != null){
				$scope.loadingData = false;
				failboxService.productFilteredThree(category, subcategory, brand).then(function(data){
					$scope.itemsCart = data;
					$scope.loadingData = true;
				});
			}else{
				if(category != null && subcategory != null){
					$scope.loadingData = false;
					failboxService.productFilteredTwo(category, subcategory).then(function(data){
						$scope.itemsCart = data;
						$scope.loadingData = true;
					});
				}else{
					if(category != null){
						$scope.loadingData = false;
						failboxService.productFilteredOne(category).then(function(data){
							$scope.itemsCart = data;
							$scope.loadingData = true;
						});
					}else{
						$scope.loadingData = false;
						failboxService.productFiltered().then(function(data){
							$scope.itemsCart = data;
							$scope.loadingData = true;
						});
					}
				}
			}
		}])

		.controller('itemController', ['$scope', '$routeParams', 'failboxService', function($scope, $routeParams, failboxService){
			var id = parseInt($routeParams.id, 10);
			$scope.loadingData = false;
			failboxService.byItem(id).then(function(data){
				$scope.item = data;
				$scope.loadingData = true;
			});
		}]);

})();
