(function(){

	angular.module('failboxStore.directives', [])

		.directive('topMenu', function(){
			return {
        restrict: 'E',
        templateUrl: './partials/top-menu.html',
				controller: function($document){
					$('input.barNav').keyup(function(){
						var textKey = $(this).val();
						if(textKey.length>1){
							$.ajax({
								type: 'GET',
								url: './php/search.php',
								data: {
									search : textKey
								},
								success : function(result){
									result = jQuery.parseJSON(result);
									var resultElemets = "";
									$('.contElements').html('');
									$.each(result, function(key, data){
										var price = parseInt(data.price);
										var not_price = parseInt(data.not_price);
										resultElemets += '<a href="#/articulo/'+data.url+'"><div class="itemSearched"><img style="width: 4vw; height: 4vw; " src="./admin/images/products/'+data.image+'"><div><span style="display: block; text-align: center; font-weight: bold; font-size: 1.2em;">'+data.name+'</span><span style="display: block; text-align: center; margin-top: 2px"><span style="text-decoration: line-through">$'+price.toFixed(2)+'</span> - <span style="font-weight: bold; color: red;">$'+not_price.toFixed(2)+'</span></span></div></div></a>';
									});
									if(resultElemets.length>0){
										$('.contElements').html(resultElemets);
									}else{
										$('.contElements').html('<div class="itemSearched"><div><span style="display: block; text-align: center; font-weight: bold; font-size: 1.2em;">Ningún resultado encontrado.</span></div></div>')
									}

								},
								error : function(){
									alert('Error');
								},
								timeout: 10000
							});
						}else{
							$('.contElements').html('');
						}






						// <a href="#">
						// 	<div class="itemSearched">
						// 		<img src="src/images/8.png">
						// 		<div>
						// 			<span style="display: block; text-align: center; font-weight: bold; font-size: 1.2em;">Insignia - Pantalla de 40 - LED - 1080p HDTV - Negro</span>
						// 			<span style="display: block; text-align: center; margin-top: 2px"><span style="text-decoration: line-through">$5,900.00</span> - <span style="font-weight: bold; color: red;">$5,000.00</span></span>
						// 		</div>
						// 	</div>
						// </a>
						//


					});

					$(document).on('click', '.itemSearched', function(){
						$('input.barNav').val('');
						$('input.barNav').keyup();
					});


				}
			};
		})

		.directive('showModalVideo', function(){
			return {
        restrict: 'E',
        templateUrl: './partials/show-modal-video.html',
				controller: function($document){
					$( ".titleNav" ).click(function() {
						$('.background-blur').css('z-index','10');
						$('.background-blur').css('opacity','.6');
						$('.video-modal').css('z-index','10');
						$('.video-modal').css('opacity','1');
					});

					$( ".close-blur" ).click(function() {
						$('.background-blur').css('z-index','-10');
						$('.background-blur').css('opacity','0');
						$('.video-modal').css('z-index','-10');
						$('.video-modal').css('opacity','0');
					});

				}
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
            $('.imgInfo', this).css({ 'opacity' : '1' });
						$('.divCapa', this).css({ 'opacity' : '1' });
          });

          $(document).on('mouseout', '.contItemsPosition .item .imgBox', function(){
            $(this).css({ 'cursor' : 'normal' });
            $('.imgInfo', this).css({ 'opacity' : '0' });
						$('.divCapa', this).css({ 'opacity' : '0' });
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
            $('.imgInfo', this).css({ 'opacity' : '1' });
						$('.divCapa', this).css({ 'opacity' : '1' });
          });

          $(document).on('mouseout', '.contItemsPosition .item .imgBox', function(){
            $(this).css({ 'cursor' : 'normal' });
            $('.imgInfo', this).css({ 'opacity' : '0' });
						$('.divCapa', this).css({ 'opacity' : '0' });
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

		.directive('serchProductsByFilter', function(){
				return{
					restrict: 'E',
					templateUrl: './partials/serch-products-by-filters.html'
				};
		})

		.directive('loadSearchProductsByFilters', function(){
				return function(){

					//Funcionalidad hover y unhover.
					$(document).on('mouseover', '.contItemsPosition .item .imgBox', function(){
						$(this).css({ 'cursor' : 'pointer' });
						$('.imgInfo', this).css({ 'opacity' : '1' });
						$('.divCapa', this).css({ 'opacity' : '1' });
					});

					$(document).on('mouseout', '.contItemsPosition .item .imgBox', function(){
						$(this).css({ 'cursor' : 'normal' });
						$('.imgInfo', this).css({ 'opacity' : '0' });
						$('.divCapa', this).css({ 'opacity' : '0' });
					});

					$(document).on('mouseover', '.buttonAddCart', function(){
						$(this).css({ 'cursor' : 'pointer' });
						$('img', this).attr('src', './src/images/cartimageOver.png');
					});

					$(document).on('mouseout', '.buttonAddCart', function(){
						$(this).css({ 'cursor' : 'normal' });
						$('img', this).attr('src', './src/images/cartimage.png');
					});

					//Se genera los items de navegacion del contenido.
					var tam_items = $('#slide2 .contItemsPosition div.groupItems').length-1;

					var itemSelecteds = '<span class="first" style="display:none; z-index: -10;"><img src="./src/images/first.png" style="width: .9em;"></span>';
					itemSelecteds+= '<span class="before" style="display:none; z-index: -10;"><img src="./src/images/before.png" style="width: .9em;"></span>';
					itemSelecteds+= '<div style="display: inline-block;" class="itemsContend">';
					for(var i=0; i<tam_items; i++){
						if(i==0)
							itemSelecteds+= '<span class="selected" name="'+(i+1)+'">'+(i+1)+'</span>';
						else
							itemSelecteds+= '<span name="'+(i+1)+'">'+(i+1)+'</span>';
					}
					itemSelecteds+= '</div>';
					itemSelecteds+= '<span class="next"><img src="./src/images/next.png" style="width: .9em;"></span>';
					itemSelecteds+= '<span class="last"><img src="./src/images/last.png" style="width: .9em;"></span>';
					$('.itemSelecteds').html(itemSelecteds);

					//Ajusta tamaño de los divs.
					$('#slide2 .contendItems .contItemsPosition').css({
						'width' : (tam_items+1)*100+"%"
					});

					$('#slide2 .contItemsPosition .groupItems').css({
						'width' : 100/(tam_items+1)+"%"
					});

					//Cuando das click en los elementos items, para poder visualizar.
					var item_selected = 0;

					$('.first').click(function(){
						itemSelected = 1;
						handlerShow(itemSelected);
						$('.itemsContend span').removeClass('selected');
						$('.itemsContend span[name='+itemSelected+']').addClass('selected');
					});

					$('.before').click(function(){
						itemSelected = item_selected;
						handlerShow(itemSelected);
						$('.itemsContend span').removeClass('selected');
						$('.itemsContend span[name='+itemSelected+']').addClass('selected');
					});

					$('.next').click(function(){
						itemSelected = item_selected+2;
						handlerShow(itemSelected);
						$('.itemsContend span').removeClass('selected');
						$('.itemsContend span[name='+itemSelected+']').addClass('selected');
					});

					$('.last').click(function(){
						itemSelected = tam_items;
						handlerShow(itemSelected);
						$('.itemsContend span').removeClass('selected');
						$('.itemsContend span[name='+itemSelected+']').addClass('selected');
					});

					$('.itemsContend span').click(function(){
						var itemSelected = $(this).attr('name');
						$('.itemsContend span').removeClass('selected');
						$(this).addClass('selected');
						handlerShow(itemSelected);
					});

					function handlerShow(itemSelected){
						item_selected = itemSelected - 1;

						if(item_selected == (tam_items-1))
							$('.next, .last').css({'display':'none'});
						else
							$('.next, .last').css({'display':'inline-block'});

						if(item_selected == 0)
							$('.first, .before').css({'display':'none'});
						else
							$('.first, .before').css({'display':'inline-block'});

						$('#slide2 .contendItems .contItemsPosition').css({
							'margin-left' : '-'+(item_selected*100)+'%'
						});
					}

					if(tam_items==0){
						$('.first, .before, .next, .last').css({'display':'none'});
					}

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
    })

		.directive('groupProductsItems', function(){
			return{
        restrict: 'E',
        templateUrl: './partials/group-products-item.html'
			};
		})

		.directive('listProductsFiltered', function(){
			return{
        restrict: 'E',
        templateUrl: './partials/list-products-filtered.html',
				controller: function($document){
					// //$(document).on('click', 'span.category', function(){
					// $('span.category').click(function(){
					// 	$('ul.subcategoryList').slideUp();
					// 	$(this).siblings('ul.subcategoryList').slideDown();
					// });
					//
					// //$(document).on('click', 'span.subcategory', function(){
					// $('span.subcategory').click(function(){
					// 	$('ul.brandList').slideUp();
					// 	$(this).siblings('ul.brandList').slideDown();
					// });
				}
			};
		})

		.directive('loadGroupProductsItems', function(){
			return function(){
				$('ul.brandList').slideUp(0);
				$('ul.subcategoryList').slideUp(0);

				// //$(document).on('click', 'span.category', function(){
				// $('span.category').click(function(){
				// 	$('ul.subcategoryList').slideUp();
				// 	$(this).siblings('ul.subcategoryList').slideDown();
				// });
				//
				// //$(document).on('click', 'span.subcategory', function(){
				// $('span.subcategory').click(function(){
				// 	$('ul.brandList').slideUp();
				// 	$(this).siblings('ul.brandList').slideDown();
				// });

			}
		})

		.directive('formContactoFailbox', function(){
			return{
				restrict: 'E',
				templateUrl: './partials/form-contacto-failbox.html',
				controller: function($document){
						$('#formContact').submit(function(e){
							var data = $(this).serialize();
							$.ajax({
								type: 'POST',
								url: 'php/sendEmail.php',
								data: data,
								success : function(result){
									$('#successMail').css('display', 'block');
									setTimeout(function(){
									  $('#formContact')[0].reset();
											$('#successMail').css('display', 'none');
									}, 1500);
								},
								error: function(){
									alert('error');
								},
								timeout: 10000
							});
							e.preventDefault();
						});
				}
			}
		})

})();
