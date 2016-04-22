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

    .directive('sliderCartNew', function(){
        return{
            restrict: 'E',
            templateUrl: './partials/slider-cart-new.html'
        };
    })

    .directive('loadSliderCartNew', function(){
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

          var tam_items = $('#slide1 .contItemsPosition div.groupItems').length-1;
          if(tam_items==0){
            $('#slide1 .rightItem, #slide1 .leftItem').css({
              'opacity' : '0',
              'z-index' : '-1'
            });
          }else{
            $('#slide1 .rightItem, #slide1 .leftItem').css({
              'opacity' : '1',
              'z-index' : '10'
            });
          }

          $('#slide1 .contendItems .contItemsPosition').css({
            'width' : (tam_items+1)*100+"%"
          });

          $('#slide1 .contItemsPosition .groupItems').css({
            'width' : 100/(tam_items+1)+"%"
          });

          var item_selected = 0;
          $('#slide1 .rightItem').click(function(){
            if(item_selected==tam_items)
              item_selected=0;  
            else
              item_selected++;
            $('#slide1 .contendItems .contItemsPosition').css({
              'margin-left' : '-'+(item_selected*100)+'%'
            });
          });

          $('#slide1 .leftItem').click(function(){
            if(item_selected==0)
              item_selected=tam_items;  
            else
              item_selected--;
            $('#slide1 .contendItems .contItemsPosition').css({
              'margin-left' : '-'+(item_selected*100)+'%'
            });
          }); 

        };
    })

    .directive('sliderCartFeactured', function(){
        return{
            restrict: 'E',
            templateUrl: './partials/slider-cart-feactured.html'
        };
    })

    .directive('loadSliderCartFeactured', function(){
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

          var tam_items = $('#slide2 .contItemsPosition div.groupItems').length-1;
          if(tam_items==0){
            $('#slide2 .rightItem, #slide2 .leftItem').css({
              'opacity' : '0',
              'z-index' : '-1'
            });
          }else{
            $('#slide2 .rightItem, #slide2 .leftItem').css({
              'opacity' : '1',
              'z-index' : '10'
            });
          }

          $('#slide2 .contendItems .contItemsPosition').css({
            'width' : (tam_items+1)*100+"%"
          });

          $('#slide2 .contItemsPosition .groupItems').css({
            'width' : 100/(tam_items+1)+"%"
          });

          var item_selected = 0;
          $('#slide2 .rightItem').click(function(){
            if(item_selected==tam_items)
              item_selected=0;  
            else
              item_selected++;
            $('#slide2 .contendItems .contItemsPosition').css({
              'margin-left' : '-'+(item_selected*100)+'%'
            });
          });

          $('#slide2 .leftItem').click(function(){
            if(item_selected==0)
              item_selected=tam_items;  
            else
              item_selected--;
            $('#slide2 .contendItems .contItemsPosition').css({
              'margin-left' : '-'+(item_selected*100)+'%'
            });
          }); 

        };
    })

    .directive('bottomSite', function(){
        return{
            restrict: 'E',
            templateUrl: './partials/bottom-site.html'
        };
    })

    .directive('descGeneralItem', function(){
        return{
            restrict: 'E',
            templateUrl: './partials/desc-general-item.html'
        }
    })

    .directive('loadDescGenItem', function(){
        return function(){

             var tam_items = $('.sliderContenido li').length-1;

              $('.sliderContenido').css({
                'width' : (tam_items+1)*100+"%"
              });

              $('.sliderContenido li').css({
                'width' : 100/(tam_items+1)+"%"
              });

              var item_selected = 0;
              $('.itemSliderConten ul li').click(function(){

                $('.itemSliderConten li img').attr("src", "./src/images/seitemnot.png");
                $('img', this).attr("src", "./src/images/seitem.png");

                item_selected = $(this).index();
                $('.sliderContenido').css({
                  'margin-left' : '-'+(item_selected*100)+'%'
                });
              }); 

        };
    });

})();