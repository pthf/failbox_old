(function (){

	angular.module('failboxStore.directives', [])

		.directive('topMenu', function() {
			return {
				restrict: 'E',
            	templateUrl: './partials/top-menu.html'
			}
		});

})();