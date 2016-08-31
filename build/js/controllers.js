(function(){

	angular.module('failboxStore.controllers', [])

		.controller('connectFacebookController', ['$scope', function($scope){

			$(function() {

				var app_id = '1202462553107160';
				var scopes = 'email, user_friends, public_profile';
				var btn_login = '<a href="#" id="login" class="btn btn-primary">Iniciar sesión</a>';
				var div_session = "<div id='facebook-session'> <strong></strong> <img> <a href='#' id='logout' class='btn btn-danger'>Cerrar sesión</a> </div>";

				window.fbAsyncInit = function() {
					FB.init({
						appId      : app_id,
						status     : true,
						cookie     : true,
						xfbml      : true,
						version    : 'v2.7'
					});
					FB.getLoginStatus(function(response) {
						console.log(response);
						statusChangeCallback(response, function() {});
					});
				};

				var statusChangeCallback = function(response, callback) {
					console.log(response);
					if (response.status === 'connected') {
						getFacebookData();
					} else {
						callback(false);
					}
				}

				var checkLoginState = function(callback) {
					FB.getLoginStatus(function(response) {
						callback(response);
					});
				}

				var getFacebookData =  function() {
					FB.api('/me', {fields: 'id,name,birthday,email,age_range,first_name,last_name,location,hometown,locale,link,gender,picture,timezone,updated_time,verified'}, function(response) {
						console.log(JSON.stringify(response));
						$('#login').after(div_session);
						$('#login').remove();
						$('#facebook-session strong').text("Welcome: "+response.name);
						$('#facebook-session img').attr('src','http://graph.facebook.com/'+response.id+'/picture?type=large');
					});
				}

				var facebookLogin = function() {
					checkLoginState(function(data) {
						if (data.status !== 'connected') {
							FB.login(function(response) {
								if (response.status === 'connected')
								getFacebookData();
							}, {scope: scopes});
						}
					})
				}

				var facebookLogout = function() {
					checkLoginState(function(data) {
						if (data.status === 'connected') {
							FB.logout(function(response) {
								$('#facebook-session').before(btn_login);
								$('#facebook-session').remove();
							})
						}
					})
				}

				$(document).on('click', '#login', function(e) {
					e.preventDefault();
					facebookLogin();
				})

				$(document).on('click', '#logout', function(e) {
					e.preventDefault();
					if (confirm("¿Está seguro?"))
					facebookLogout();
					else
					return false;
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

		.controller('tabShowMenuTopController',['$scope', function($scope){

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

		// .controller('showProdutsByFilters', ['$scope', '$routeParams', 'failboxService', function($scope, $routeParams, failboxService){
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
