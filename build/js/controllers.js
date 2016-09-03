(function(){

	angular.module('failboxStore.controllers', [])

		.controller('connectFacebookController', ['$scope', '$rootScope', function($scope, $rootScope){

			$(function() {

				var app_id = '1202462553107160';
				var scopes = 'email, user_friends, public_profile';

				window.fbAsyncInit = function() {
					FB.init({
						appId      : app_id,
						status     : true,
						cookie     : true,
						xfbml      : true,
						version    : 'v2.7'
					});
					FB.getLoginStatus(function(response) {
						statusChangeCallback(response, function() {});
					});
				};

				var statusChangeCallback = function(response, callback) {
					console.log(response);
					if (response.status === 'connected') {
						$rootScope.loginUser = response.authResponse.userID;
						getFacebookData(response);
					} else {
						// $rootScope.loginUser = 0;
						callback(false);
					}
				}

				var checkLoginState = function(callback) {
					FB.getLoginStatus(function(response) {
						callback(response);
					});
				}

				var getFacebookData =  function(status) {
					FB.api('/me', {fields: 'id,name,birthday,email,age_range,first_name,last_name,location,hometown,locale,link,gender,picture,timezone,updated_time,verified'}, function(response) {
						$.ajax({
							url : './php/user.php',
							type: 'POST',
							data: {
								id: response.id,
								first_name: response.first_name,
								last_name: response.last_name,
								email: response.email,
								password: status.authResponse.accessToken,
								namefunction : 'loginFB'
							},
							success: function(result){
								$rootScope.loginUser = response.id;
							},
							error: function(){
								alert('Error');
							},
							timeout: 10000
						})
					});
				}

				var facebookLogin = function() {
					checkLoginState(function(data) {
						if (data.status !== 'connected') {
							FB.login(function(response) {
								if (response.status === 'connected')
								getFacebookData(response);
							}, {scope: scopes});
						}
					})
				}

				var facebookLogout = function() {
					checkLoginState(function(data) {
						if (data.status === 'unknown'){
							$.ajax({
								url : './php/user.php',
								type: 'POST',
								data: {
									namefunction : 'logout'
								},
								success: function(result){
									$rootScope.loginUser = 0;
								},
								error: function(){
									alert('Error');
								},
								timeout: 10000
							})
						}else{
							if (data.status === 'connected') {
								FB.logout(function(response) {
									$.ajax({
										url : './php/user.php',
										type: 'POST',
										data: {
											namefunction : 'logout'
										},
										success: function(result){
											$rootScope.loginUser = 0;
										},
										error: function(){
											alert('Error');
										},
										timeout: 10000
									})
								})
							}
						}
					})
				}

				$(document).on('click', '.setDataFB', function(e) {
					e.preventDefault();
					facebookLogin();
					$('.modal-header button.close').trigger('click');
				})

				$(document).on('click', '.logOut', function(e) {
					e.preventDefault();
					facebookLogout();
				})

			})

		}])

		.controller('topMenuController', ['$scope', 'failboxService', function($scope, failboxService){
			failboxService.showMenuCategories().then(function(data){
				$scope.menuProductos = data;
			});
			var activeCategory = false;
			$scope.openCategory = function(categoryName){
				//if(!activeCategory){
					activeCategory = true;
					$('ul.subcategoryList').slideUp();
					$('span[name="'+categoryName+'"]').siblings('ul.subcategoryList').slideDown();
				//}else{
					//activeCategory = false;
					//$('ul.subcategoryList').slideUp();
					//$('span[name="'+categoryName+'"]').siblings('ul.subcategoryList').slideUp();
				//}
			};

			var activeSubCategory = false;
			$scope.openSubCategory = function(categoryName){
				//if(!activeSubCategory){
					activeSubCategory = true;
					$('ul.brandList').slideUp();
					$('span[name="'+categoryName+'"]').siblings('ul.brandList').slideDown();
				//}else{
					//activeSubCategory = false;
					//$('ul.brandList').slideUp();
					//$('span[name="'+categoryName+'"]').siblings('ul.brandList').slideUp();
				//}
			};

		}])

		.controller('tabShowMenuTopController',['$scope', '$rootScope', function($scope, $rootScope){

			this.menuProductos = false;
			this.menuCuenta = false;
			this.menuBrand = 0;
			this.tab_selected = 0;
			this.registro;

			this.selectBrand = function(brandSelect){
					this.menuBrand = brandSelect;
			};

			this.selectTab = function(tab_selected){
				this.tab_selected = tab_selected;
			};

			this.openMenu = function(){
				this.menuProductos = !this.menuProductos;
			};

			this.openCuenta = function(registro){
				if(typeof registro != 'undefined'){
					$('.modal .inicio, .modal .registro').hide();
					if(registro == 0)
						$('.modal .inicio').show();
					else
						$('.modal .registro').show();
					$scope.registro = registro;

					$('.modal').modal({
					    show: 'false'
					});
					$('.modal').on('hidden.bs.modal', function () {
						$.each($('#popup-registrar').find('form'), function(k , v){
							v.reset();
							$.each($(v).find('input'), function(ke, va){
								$(va).attr('style', '');
							})
						})
					});
				}
				this.menuCuenta = !this.menuCuenta;
			};

			this.closeMenuRestart = function(){
				this.menuProductos = false;
				this.menuCuenta = false;
				this.menuBrand = 0;
				this.tab_selected = 0;
			};

		}])

		.controller('tabShowMenuTopControllerMobile',['$scope', function($scope){

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

			$(document).ready(function(){

				setTimeout(function(){
					$('.navbar-nav .menuMobile').click(function(e){
						e.stopPropagation();
						$el = $(e.currentTarget).find('.sub');
						if($(e.currentTarget).find('.sub').is(':hidden')){
							$('.navbar-nav .menuMobile').find('.sub').slideUp();
							$el.slideToggle();
						}
					});
					$('.close-menu').click(function(){
						$(".navbar-collapse").collapse('hide');
					})
				}, 1000);
			});
		}])

		.controller('homeSliderController', ['$scope', 'failboxService', function($scope, failboxService){
			$scope.loadingData = false;
			failboxService.sliderHome().then(function(data){
				$scope.bannerMenu = data;
				$scope.loadingData = true;
				$scope.getLocation = function(url){
					console.log(url);
				}
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

		.controller('getListItemsCart', ['$scope', 'failboxService', '$rootScope', function($scope, failboxService, $rootScope){

			$scope.loadingData = false;
			$scope.loadingDataPedido = false;
			$scope.datesPedidoCart = false;
			$scope.totalCart = 0.0;
			failboxService.products_cart().then(function(data){

				$scope.itemsCart = data;
				$rootScope.$on('shopping:add', function(event, data){
					$scope.itemsCart = data;
				});
				$scope.loadingData = true;
			});
			failboxService.idpedido_cart().then(function(data){
				$scope.idPedido = data;
				$scope.loadingDataPedido = true;
			});
			failboxService.dates_pedido().then(function(data){
				$scope.datesPedido = data;
				$scope.datesPedidoCart = true;
			});
			failboxService.total_cart().then(function(data){
				$scope.totalCart = data;
			});
		}])

		.controller('purchaseSummary', ['$scope', 'failboxService', '$rootScope', function($scope, failboxService, $rootScope){
			$scope.loadingData = false;
			$scope.totalCart = 0.0;
			$scope.costShipping = 0.0;
			$scope.totalNotPrice = 0.0;
			failboxService.summary_products_cart().then(function(data){
				$scope.itemsCart = data;
				$scope.loadingData = true;
			});
			failboxService.total_cart().then(function(data){
				$scope.totalCart = data;
				$rootScope.$on('shopping:price', function(event, args){
					$scope.totalCart = args;
				});
			});
			failboxService.cost_shipping().then(function(data){
				$scope.costShipping = data;
			});
			failboxService.total_notprice().then(function(data){
				$scope.totalNotPrice = data;
			});
		}])

		.controller('countItemsCart', ['$scope', 'failboxService','$rootScope', function($scope, failboxService, $rootScope){
			$scope.loadingData = false;
			failboxService.count_items_cart().then(function(data){
				$scope.countCart = data;
				$scope.loadingData = true;
			});
			$rootScope.$on('shopping:count', function(event, args){
				$scope.countCart = args;
			})

		}])

		.controller('idPedidoCart', ['$scope', '$routeParams', 'failboxService', function($scope, $routeParams, failboxService){
		    $scope.idPedido = [];
		    $scope.id = parseInt($routeParams.id);
		    failboxService.getIdPedido($scope.id).then(function(data){
		      $scope.idPedido = data;
		    });
		}])

		.controller('showProdutsByFilters', ['$scope', '$routeParams', 'failboxService', '$rootScope', function($scope, $routeParams, failboxService, $rootScope){

			var category = $routeParams.category;
			var subcategory = $routeParams.subcategory;
			var brand = $routeParams.brand;
			//$rootScope.pages =$rootScope.pages +1;

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
			setTimeout(function(){

				$('.sliderCat .itemSelecteds .itemsContend span').click(function(e){
			    	$rootScope.pages = $(e.currentTarget).attr('name');
					console.log($rootScope.pages);
				});
				$('.sliderCat .itemSelecteds .first, .sliderCat .itemSelecteds .before, .sliderCat .itemSelecteds .next, .sliderCat .itemSelecteds .last').click(function(){
					$rootScope.pages = $('.sliderCat .itemSelecteds .itemsContend span.selected').attr('name');
				})
			}, 800)

		}])

		.controller('itemController', ['$scope', '$routeParams', 'failboxService', function($scope, $routeParams, failboxService){
			var url = $routeParams.url;
			$scope.loadingData = false;
			$scope.quantity = 1;
			$scope.disabled = false;
			$scope.readonly  = true;

			failboxService.byItem(url).then(function(data){
				dif = data.not_price - data.price;
 				decimal = Math.abs( dif / data.price );

				$scope.porcent = Math.round(decimal * 100);
				$scope.item = data;
				$scope.loadingData = true;

				failboxService.verificar_existencias_global($scope.item.id, 1).then(function(req){

				}).then(function(){
					failboxService.verificar_existencia_session($scope.item.id, $scope.quantity).then(function(req){
						$scope.stock_session = req.data;
					})
				}).catch(function(err){
					$scope.stock_session = 0;
					$scope.quantity = 0;
					$scope.disabled = true;
				})

			})


		}])

		.controller('carrito', ['$scope', function($scope){
			$scope.contador = 1;

			$scope.increment = function(number){
				$scope.contador= number+1;
			}
			$scope.decrement = function(number){
				if(number > 1){
					$scope.contador= number-1;
				}
			}
		}])

})();
