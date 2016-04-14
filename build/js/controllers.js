(function(){

	angular.module('failboxStore.controllers', [])

		.controller('topMenuController', ['$scope', function($scope){
			$scope.menuProductos = {
				cat : {
					'Televisiones' : {
						'LG': 1,
						'Sony': 2,
						'Insignia': 3, 
						'Samsung': 4,
						'Philips': 5
					}, 
					'Audio y Sonido' : {
						'Marca 1' : 1
					},
					'Home Theater' : {
						'Marca 6' : 2
					},
					'Videojuegos' : {
						'Marca 9' : 1
					},
					'Celulares' : {
						'Marca 13' : 1
					}
				}
			};
		}])

		.controller('tabShowMenuTopController', function(){
			this.menuProductos = false;
			this.menuCuenta = false;
			this.tab_selected = 0;
			
			this.selectTab = function(tab_selected){
				this.tab_selected = tab_selected;
			};
			
			this.openMenu = function(){
				this.menuProductos = !this.menuProductos;
			};
			
			this.openCuenta = function(){
				this.menuCuenta = !this.menuCuenta;
			};
		})
		
})();