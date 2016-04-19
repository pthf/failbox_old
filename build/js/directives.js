(function(){

	angular.module('failboxStore.directives', [])

		.directive('topMenu', function(){
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
		})

        .directive('sliderCart', function(){
            return{
                restrict: 'E',
                templateUrl: './partials/slider-cart.html'
            };
        })

        .directive('loadSliderCart', function(){
            return function(){
                $(document).on('mouseover', '.contItemsPosition .item .imgBox', function(){
                $(this).css({ 'cursor' : 'pointer' });
                $(this).css({ 'background' : 'rgba(88,89,91,.2)' });
                $('.imgInfo', this).css({ 'opacity' : '1' });
              });

              $(document).on('mouseout', '.contItemsPosition .item .imgBox', function(){
                $(this).css({ 'cursor' : 'normal' });
                $(this).css({ 'background' : '#FFF' });
                $('.imgInfo', this).css({ 'opacity' : '0' });
              });
              
              $(document).on('mouseover', '.buttonAddCart', function(){
                $(this).css({ 'cursor' : 'pointer' });
                $('img', this).attr('src', './src/images/cartimageOver.png');
              });

              $(document).on('mouseout', '.buttonAddCart', function(){
                $(this).css({ 'cursor' : 'normal' });
                $('img', this).attr('src', './src/images/cartimage.png');
              });

              var tam_items = $('.contItemsPosition div.groupItems').length-1;
              if(tam_items==0){
                $('.rightItem, .leftItem').css({
                  'opacity' : '0',
                  'z-index' : '-1'
                });
              }else{
                $('.rightItem, .leftItem').css({
                  'opacity' : '1',
                  'z-index' : '10'
                });
              }

              $('.contendItems .contItemsPosition').css({
                'width' : (tam_items+1)*100+"%"
              });

              $('.contItemsPosition .groupItems').css({
                'width' : 100/(tam_items+1)+"%"
              });

              var item_selected = 0;
              $('.rightItem').click(function(){
                if(item_selected==tam_items)
                  item_selected=0;  
                else
                  item_selected++;
                $('.contendItems .contItemsPosition').css({
                  'margin-left' : '-'+(item_selected*100)+'%'
                });
              });

              $('.leftItem').click(function(){
                if(item_selected==0)
                  item_selected=tam_items;  
                else
                  item_selected--;
                $('.contendItems .contItemsPosition').css({
                  'margin-left' : '-'+(item_selected*100)+'%'
                });
              }); 
            };
        });

})();