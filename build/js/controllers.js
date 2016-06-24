(function(){

	angular.module('failboxStore.controllers', [])

		.controller('topMenuController', ['$scope', 'failboxService', function($scope, failboxService){
			failboxService.showMenuCategories().then(function(data){
				$scope.menuProductos = data;
			});

			var activeCategory = false;
			$scope.openCategory = function(categoryName){
				if(!activeCategory){
					activeCategory = true;
					$('ul.subcategoryList').slideUp();
					$('span[name="'+categoryName+'"]').siblings('ul.subcategoryList').slideDown();
				}
			};

			var activeSubCategory = false;
			$scope.openSubCategory = function(categoryName){
				if(!activeSubCategory){
					activeSubCategory = true;
					$('ul.brandList').slideUp();
					$('span[name="'+categoryName+'"]').siblings('ul.brandList').slideDown();
				}
			};

			$scope.closeactiveCategory = function(){
				activeCategory = false;
			};

			$scope.closeactiveSubCategory = function(){
				activeSubCategory = false;
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
