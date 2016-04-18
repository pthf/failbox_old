(function(){

	angular.module('failboxStore.directives', [])

		.directive('topMenu', function() {
			return {
				restrict: 'E',
            	templateUrl: './partials/top-menu.html'
			};
		})

		.directive('sliderHome', function(){
			return{
				restrict: 'E',
				templateUrl: './partials/slider-home.html'
			};
		})

		.directive('loadHomeSlider', function(){
			return function(){
				var tam_items = $('.slider .contenedor li').length-1;
                if(tam_items==0){
                	$('.itemsSelecteds').css({
                		'display' : 'none'
                	});
                }else{
                	$('.itemsSelecteds').css({
                		'display' : 'block'
                	});
                }

                $('.slider .contenedor').css({
                	'width' : (tam_items+1)*100+"%"
                });

                $('.slider .contenedor li').css({
                	'width' : 100/(tam_items+1)+"%"
                });

                var item_selected = 0;
                $(document).on('click', '.itemsSelecteds li', function(){
                	$('.itemsSelecteds li img').attr("src", "./src/images/notselected.png");
                	$('img', this).attr("src", "./src/images/selected.png");

                	item_selected = $(this).index();
                	$('.slider .contenedor').css({
                		'margin-left' : '-'+(item_selected*100)+'%'
                	});
                });
			};
		});

})();