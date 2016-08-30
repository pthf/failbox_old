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
								$('.contElements div').html('');
								$.each(result, function(key, data){
									var price = parseInt(data.price);
									var not_price = parseInt(data.not_price);
									resultElemets += '<a href="articulo/'+data.url+'"><div class="itemSearched"><img style="width: 4vw; height: 4vw; " src="./admin/images/products/'+data.image+'"><div><span style="display: block; text-align: center; font-weight: bold; font-size: 1.2em;">'+data.name+'</span><span style="display: block; text-align: center; margin-top: 2px"><span style="text-decoration: line-through">$'+price.toFixed(2)+'</span> - <span style="font-weight: bold; color: red;">$'+not_price.toFixed(2)+'</span></span></div></div></a>';
								});
								if(resultElemets.length > 0){
									$('.contElements div').html(resultElemets);
								}else{
									$('.contElements div').html('<div class="itemSearched"><div><span style="display: block; text-align: center; font-weight: bold; font-size: 1.2em;">Ningún resultado encontrado.</span></div></div>')
								}
							},
							error : function(){
								alert('Error');
							},
							timeout: 10000
						});
					}else{
						$('.contElements div').html('');
					}
				});
				$(document).on('click', '.itemSearched', function(){
					$('input.barNav').val('');
					$('input.barNav').keyup();
				});
			}
		};
	})

	.directive('questionsList', function(){
		return{
			restrict: 'E',
			templateUrl: './partials/questions-list.html',
			controller: function($document){
				$('.faqs li div.answer').slideUp(0);
				$('.faqs li div.question').click(function(){
					$('.faqs li div.answer').slideUp(250);
					$(this).siblings('div.answer').slideDown(250);
					$('.faqs li div.question').removeClass('questionSelected');
					$(this).addClass('questionSelected');
				});

				$('.faqs .g-subs .sub').click(function(e){
					var id = $(e.currentTarget).attr('id');
					var change = $('.faqs').find('ul.'+id)
					var $ul = $('.faqs').find('ul');
					if(!change.is(':visible')){
						$ul.fadeOut('slow');
						$ul.addClass('hide');
						$ul.removeClass('show');
						change.removeClass('hide');
						change.fadeIn('slow');
						change.addClass('show');
					}
				})
			}
		}
	})

	.directive('showModalVideo', function(){
		return {
			restrict: 'E',
			templateUrl: './partials/show-modal-video.html',
			controller: function($document){

				$( ".titleNav" ).click(function() {
					$(".video-modal-wrapper").append( '<iframe id="player" type="text/html" src="https://www.youtube.com/embed/MNwd2aQlXUA?version=3&enablejsapi=1&controls=0&&showinfo=0&rel=0&amp"> </iframe>' );
					$('.background-blur').css('z-index','8');
					$('.background-blur').css('opacity','.6');
					$('.video-modal').css('z-index','8');
					$('.video-modal').css('opacity','1');
				});

				$( ".close-blur,.background-blur,.video-modal" ).click(function() {
					$('.background-blur').css('z-index','-10');
					$('.background-blur').css('opacity','0');
					$('.video-modal').css('z-index','-10');
					$('.video-modal').css('opacity','0');
					$('iframe').get(0).remove();
				});
			}
		};
	})

	.directive('sliderHome', function(){
		return{
			restrict: 'E',
			templateUrl: './partials/slider-home.html',
			controller: function($document){
				var mySwiper;
				var conf =  {
								pagination: '.pagination',
								loop:true,
								grabCursor: false,
								paginationClickable: true,
								autoplay:5500,
								speed:1000,
								calculateHeight: true,
								debugger: false,
								resizeReInit: true,
								observer: true,
								observeParents: true
							}
				setTimeout(function(){
					mySwiper = new Swiper('.swiper-container', conf)

				}, 80);
				var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
					if (!isMobile) {
					 $(window).resize(function(){
	  					location.reload();
	  				});
					}
			}
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
					'z-index' : '9'
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

			$(".buttonAddCart").click(function(e){
				e.preventDefault();
			});

		};
	})

	.directive('sliderCartFeactured', function(){
		return{
			restrict: 'E',
			templateUrl: './partials/slider-cart-feactured.html'
		};
	})

	.directive('avisoPrivacidad', function(){
		return{
			restrict: 'E',
			templateUrl: './partials/aviso-privacidad.html'
		}
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
			templateUrl: './partials/serch-products-by-filters.html',
			controller: function($document){
				$('.returnSpan').click(function(){
					parent.history.back();
					return false;
				});
			}
		};
	})

	.directive('loadSearchProductsByFilters', ['$rootScope', function($rootScope){
		return function(){
			//Paginacion dinamica
			if($rootScope.pages != 1){
				var pag = $('.sliderCat .itemSelecteds .itemsContend span').attr('name', $rootScope.pages);
				$('.sliderCat .itemSelecteds .itemsContend span').removeClass('selected')
				pag.addClass('selected');
				handlerShow($rootScope.pages);

			}
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
			var tam_items = $('#slide2 .contItemsPosition div.groupItems').length;

			var itemSelecteds = '<div class="wrap-arrow-a wrap-page"><span class="first" style="display:none; z-index: -10;"><img src="./src/images/first.png" style="width: .9em;"></span>';
			itemSelecteds+= '<span class="before" style="display:none; z-index: -10;"><img src="./src/images/before.png" style="width: .9em;"></span></div>';
			itemSelecteds+= '<div style="display: inline-block;" class="itemsContend">';
			for(var i=0; i<tam_items; i++){
				if(i==0)
				itemSelecteds+= '<span class="selected" name="'+(i+1)+'">'+(i+1)+'</span>';
				else
				itemSelecteds+= '<span name="'+(i+1)+'">'+(i+1)+'</span>';
			}
			itemSelecteds+= '</div>';
			itemSelecteds+= '<div class="wrap-arrow-b wrap-page"><span class="next"><img src="./src/images/next.png" style="width: .9em;"></span>';
			itemSelecteds+= '<span class="last"><img src="./src/images/last.png" style="width: .9em;"></span></div>';
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

			if(tam_items==1){
				$('.first, .before, .next, .last').css({'display':'none'});
			}

		};
	}])

	.directive('bottomSite', function(){
		return{
			restrict: 'E',
			templateUrl: './partials/bottom-site.html',
			controller: function($document){
				$('form#newsletterForm').submit(function(e){
					e.preventDefault();
					var email = $('.texti', this).val();
					$.ajax({
						beforeSend: function(){},
						url: './php/newletter.php',
						type: 'POST',
						data: {
							email : email
						},
						success: function(result){
							$('form#newsletterForm')[0].reset();
							$('.correctSusc').css({
								'opacity' : '1'
							});
							setTimeout(function(){
								$('.correctSusc').css({
									'opacity' : '0'
								});
							}, 2000);
						},
						error: function(){
							alert('Error');
						},
						timeout: 10000
					});
				});

				$('a.ancla').click(function(e){
					e.preventDefault();
					enlace  = $(this).attr('href');
					$('html, body').animate({
						scrollTop: $(enlace).offset().top-160
					}, 1000);
				});

			}
		};
	})

	.directive('descGeneralItem', function(){
		return{
			restrict: 'E',
			templateUrl: './partials/desc-general-item.html',
			controller: function($document){
				var mySwiper;
				setTimeout(function(){
					mySwiper = new Swiper('.swiper-container',{
						pagination: '.pagination',
						loop:false,
						grabCursor: false,
						paginationClickable: true,
						calculateHeight: true,
						speed:800,
						debugger: false
				  	})
				}, 80);
				$(window).resize(function(){
				  mySwiper.reInit() // or mySwiper.resizeFix()
				});
				$('.returnSpan').click(function(){
					parent.history.back();
					return false;
				});
				$('.informacion-producto .titulo').click(function(){
					if($('.informacion-producto .contenedor').is(':visible')){
						$('i').removeClass('glyphicon-chevron-up');
						$('i').addClass('glyphicon-chevron-down');
					}else{
						$('i').removeClass('glyphicon-chevron-down');
						$('i').addClass('glyphicon-chevron-up');
					}

					$('.informacion-producto .contenedor').slideToggle('')
				})
				/* Decrementar valor del input sobre la cantidad de stocks a comprar
				var i = 1;
				$(document).on('click', '.menos', function(){
				    if(i>=2){
				        i = i - 1;
				        var idProduct = $(this).attr('data-id-product');
					    var name = $(this).attr('data-name');
					    var notprice = $(this).attr('data-notprice');
				        var cant = document.getElementById("cantidad");
				        cant.value = i;
				        if(cant.value == 1){
				            i=1;
				            cant.value="1";
				        }
				        $('.test_stock').remove();
				    	$('.test_stock_').html('<div class="buttonAddCart" data-id="'+idProduct+'" data-name="'+name+'" data-price="" data-notprice="'+notprice+'" data-quantity="'+cant.value+'" data-stocks=""><img src="./src/images/carrito/agregar-carrito.png"></div>');
				    }

				});

				// Incrementar valor del input sobre la cantidad de stocks a comprar
				var i = 1;
				$(document).on('click', '.mas', function(){
				    i = i + 1;
				    var idProduct = $(this).attr('data-id-product');
				    var name = $(this).attr('data-name');
				    var notprice = $(this).attr('data-notprice');
				    var cant = document.getElementById("cantidad");
				    cant.value = i;

				    if(cant.value == 1){
			            i=1;
			            cant.value="1";
				    }
				    $('.test_stock').remove();
				    $('.test_stock_').html('<div class="buttonAddCart" data-id="'+idProduct+'" data-name="'+name+'" data-price="" data-notprice="'+notprice+'" data-quantity="'+cant.value+'" data-stocks=""><img src="./src/images/carrito/agregar-carrito.png"></div>');
				});
				*/
			}
		}
	})

	.directive('loadDescGenItem', function(){
		return function(){

			$(document).on('mouseover', '.buttonAddCart', function(){
				$(this).css({ 'cursor' : 'pointer' });
				$('img', this).attr('src', './src/images/cartimageOver.png');
			});

			$(document).on('mouseout', '.buttonAddCart', function(){
				$(this).css({ 'cursor' : 'normal' });
				$('img', this).attr('src', './src/images/cartimage.png');
			});

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
				$(document).on('click', '.groupAllItems img', function(e){
					$('.groupAllItems img').attr('src','./src/images/viewmore-aside.png');
					$(this).attr('src','./src/images/viewmore.png');
				});
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

	.directive('datosEnvio', function(){
		return{
			restrict: 'E',
			templateUrl: './partials/datos-envio.html',
			controller: function($document){
				setTimeout(function(){
					idpedido = $("#idpedido_resumen").attr('pedido');
					totalCart = $("#total").attr('total');
					totalNotCart = $("#totalnot").attr('totalnot');
					if (idpedido == '') {
						$('.form1').remove();
						$('#formDatesSend').submit(function(){
							var ajaxData = new FormData();
							ajaxData.append("action", $(this).serialize());
							ajaxData.append("namefunction", "registrar_datos_pago");
							ajaxData.append("total_cart", totalCart);
							ajaxData.append("total_not_cart", totalNotCart);
							$.ajax({
								type: 'POST',
								url: './php/functions_cart.php',
								data: ajaxData,
								processData: false,
								contentType: false,
								success : function(result){
									if (result == -1) {
										$('.result_cart').html('Agrega productos al carrito para realizar el pedido.');
										$('.result_cart').css({'opacity' : '1'});
										setTimeout(function () {
											$('.result_cart').css({'opacity' : '0'});
											$('.result_cart').text('');
										}, 5000);
										$('#formDatesSend')[0].reset();
									}else {
										// alert(result);
										$('#formDatesSend')[0].reset();
										window.location.href = "resumen-compra";
									};
								},
								error: function(){
									alert('error');
								},
								timeout: 10000
							});
						});
					} else if(idpedido){
						$('.form2').remove();
						$('#formDatesSend_').submit(function(){
							var ajaxData = new FormData();
							ajaxData.append("action", $(this).serialize());
							ajaxData.append("namefunction", "registrar_datos_pago");
							ajaxData.append("total_cart", totalCart);
							ajaxData.append("total_not_cart", totalNotCart);
							$.ajax({
								type: 'POST',
								url: './php/functions_cart.php',
								data: ajaxData,
								processData: false,
								contentType: false,
								success : function(result){
									if (result == -1) {
										$('.result_cart').html('Agrega productos al carrito para realizar el pedido.');
										$('.result_cart').css({'opacity' : '1'});
										setTimeout(function () {
											$('.result_cart').css({'opacity' : '0'});
											$('.result_cart').text('');
										}, 5000);
										$('#formDatesSend_')[0].reset();
									}else {
										// alert(result);
										$('#formDatesSend_')[0].reset();
										window.location.href = "resumen-compra";
									};
								},
								error: function(){
									alert('error');
								},
								timeout: 10000
							});
						});
					};
				}, 250);
			}
		}
	})

	.directive('resumenCompra', function(){
		return{
			restrict: 'E',
			templateUrl: './partials/resumen-compra.html',
			controller: function($document){
				setTimeout(function(){
					idpedido = $("#idpedido_resumen").attr('pedido');
					// alert(idpedido);
					if (idpedido == '') {
						window.location.href = "datos-envio";
					};
				}, 250);
				$(document).on('click', '.formPaypal', function(){
				  	$.ajax({
			          	beforeSend: function(){
			      		},
			          	url: "./php/functions_cart.php",
			          	type: "POST",
			          	data: {
			              	namefunction:'actualizar_carrito_confirmar'
			          	},
			          	success: function(data){
			          		if (data == 1) {
			          			// alert('Comprar en Paypal');
				  				$( "#target" ).submit();
			          		} else if(data == -1){
			          			alert('El numero de existencias excede de algunos productos, se ajustaran de acuerdo a las existencias del producto');
			          			location.reload();
			          		} else {
			          			alert('Algunos productos se agotaron, serán eliminados del carrito');
			          			location.reload();
			          		};
			          	},
			          	error: function(){
			          	},
			          	complete: function(){
			          	},
			          	timeout: 10000
			      	});
				});
			}
		}
	})

	.directive('buySlide', function(){
		return{
			restrict: 'E',
			templateUrl: './partials/buy-slide.html',
			controller: function($document){
			}
		}
	})

	.directive('agradecimiento', function(){
		return{
			restrict: 'E',
			templateUrl: './partials/agradecimiento.html',
			controller: function($document){
				// setTimeout(function(){
				// 	idpedido = $("#idpedido_resumen").attr('pedido');
				// 	if (idpedido == '') {
				// 		window.location.href = "productos";
				// 	}
				// 	// else{
				// 	// 	$.ajax({
				//  //          	beforeSend: function(){
				//  //      		},
				//  //          	url: "./php/functions_cart.php",
				//  //          	type: "POST",
				//  //          	data: {
				//  //              	namefunction:'verify_idpedido',
				//  //              	idpedido: idpedido
				//  //          	},
				//  //          	success: function(data){
				//  //          		alert(data);
				//  //          		// window.location.href = "datos-envio";
				//  //          		// $('.g_cart_cont').html(data);
				//  //          	},
				//  //          	error: function(){
				//  //          	},
				//  //          	complete: function(){
				//  //          	},
				//  //          	timeout: 10000
				//  //      	});
				// 	// };
				// }, 250);
			}
		}
	})

	.directive('cancelado', function(){
		return{
			restrict: 'E',
			templateUrl: './partials/cancelado.html',
			controller: function($document){
			}
		}
	})

	.directive('productsMyCart', function(){
		return{
			restrict: 'E',
			templateUrl: './partials/products-my-cart.html',
			controller: function($document){
				//Reduciremos el numero de cantidad a menos uno, eso cuando el usuario de click en el boton less.
			  	$(document).on('click', '.menos_', function(){
				  	var idItemCart = $(this).attr('name');
			  		disminuir_item_cart(idItemCart);
			  		actualizar_carrito();
				});

				$(document).on('click', '.mas_', function(){

				  	var idItemCart = $(this).attr('name');
				  	var quantity = $(this).attr('data-quantity');
				  	$.ajax({
						url: "./php/functions_cart.php",
						type: "POST",
						data: {
				            namefunction: 'verify_stocks',
				            idProduct: idItemCart,
				            quantity: quantity
				    	},
						success: function(result){
							// alert(result);
							if(result==1 || result==-1){
								incrementar_item_cart(idItemCart);
								actualizar_carrito();
								// actualizar_carrito_confirmar(idItemCart,quantity);
							} else if(result == 0){
								alert('No hay existencias');
								// $('.result_products').html('No hay existencias.');
								// $('.result_products').css({'opacity' : '1'});
								// setTimeout(function () {
								// 	$('.result_products').css({'opacity' : '0'});
								// 	$('.result_products').text('');
								// }, 5000);
							}
						},
						error: function(error){
							alert(error);
						}
					});
				});

				$(document).on('click', '.buttonBuyNow', function(){
					$.ajax({
			          	beforeSend: function(){
			      		},
			          	url: "./php/functions_cart.php",
			          	type: "POST",
			          	data: {
			              	namefunction:'actualizar_carrito_confirmar'
			          	},
			          	success: function(data){
			          		// alert(data);
			          		window.location.href = "datos-envio";
			          		// $('.g_cart_cont').html(data);
			          	},
			          	error: function(){
			          	},
			          	complete: function(){
			          	},
			          	timeout: 10000
			      	});
				});

				$(document).on('click', '.deleteItemCart', function(e){
				  	var idItemCart = $(this).attr('name');
				  	// alert(idItemCart);
				  	$.ajax({
			          	beforeSend: function(){
			      		},
			          	url: "./php/functions_cart.php",
			          	type: "POST",
			          	data: {
			              	namefunction:'eliminar_item_cart',
			              	idItemCart: idItemCart
			          	},
			          	success: function(data){
			          		// alert(data);
			          		//location.reload();
							if($('.productos').find('.producto:visible').length != 0){
								$(e.target).closest('.producto').fadeOut('', function(){
									$(this).remove();
									$('.productos').find('.producto:first-child').css('border', '1px solid #58595b');
									if($('.productos:visible').find('.producto').length == 0 ){
										location.reload();
									}
								});
							}

			          	},
			          	error: function(){
			          	},
			          	complete: function(){
			          	},
			          	timeout: 10000
			      	});

				});
			}
		};
	})

	.directive('buttonAddCart', ['$rootScope', 'failboxService', '$timeout', function($rootScope, failboxService, $timeout) {
     	return {
          	restrict: 'C',
			replace : false,
			transclude: false,
          	link: function(scope, element, attrs) {

				element.bind('click', function() {

					$timeout(function(){
						failboxService.products_cart().then(function(data){

							$rootScope.$emit('shopping:add', data);
						}).then(function(){
							failboxService.total_cart().then(function(data){

								$rootScope.$emit('shopping:price', data);
							});
						})
						failboxService.count_items_cart().then(function(data){

							$rootScope.$emit('shopping:count', data);
						})
					}, 500)

				})
          	}
      	}
    }])

	.directive('deleteItemCart', ['$rootScope', 'failboxService', '$timeout', function($rootScope, failboxService, $timeout) {
     	return {
          	restrict: 'C',
			replace : false,
          	link: function(scope, element, attrs) {
				element.bind('click', function() {
					$timeout(function(){
						failboxService.products_cart().then(function(data){
							$rootScope.$emit('shopping:add', data);
						}).then(function(){
							failboxService.total_cart().then(function(data){
								$rootScope.$emit('shopping:price', data);
							});
						})
						failboxService.count_items_cart().then(function(data){
							$rootScope.$emit('shopping:count', data);
						})
					}, 500)

				})
          	}
      	}
    }])

	.directive('mas', ['$rootScope', 'failboxService', '$timeout', function($rootScope, failboxService, $timeout) {
		return {
			restrict: 'C',
			replace : false,
			transclude: false,
          	link: function(scope, element, attrs) {
				element.bind('click', function() {
					//$rootScope.$emit('shopping:more', data);
					failboxService.verificar_existencia_session(scope.item.id, scope.quantity).then(function(req){
						scope.stock_session = req.data;
					})
				})
			}
		}
	}])
	.directive('menos', ['$rootScope', 'failboxService', '$timeout', function($rootScope, failboxService, $timeout) {
		return {
			restrict: 'C',
			replace : false,
			transclude: false,
          	link: function(scope, element, attrs) {

				element.bind('click', function() {
					//$rootScope.$emit('shopping:more', data);
					failboxService.verificar_existencia_session(scope.item.id, scope.quantity).then(function(req){
						scope.stock_session = req.data;
					})
				})
			}
		}
	}])

	$(document).on('click', '.cartBar', function(e){
		$('.buy-slide').slideToggle('fast')
	})
	$(document).on('click', '.buttonAddCart', function(e){
		e.preventDefault();
	  	var idProduct = $(this).attr('data-id');
	  	var name = $(this).attr('data-name');
	  	var notprice = $(this).attr('data-notprice');
	  	var quantity = $(this).attr('data-quantity');
	  	var stocks = $(this).attr('data-stocks');
	  	var sub_total = notprice*quantity;
	  	// var namefunction = 'verify_max_stock';
	  	$.ajax({
			url: "./php/functions_cart.php",
			type: "POST",
			data: {
	            namefunction: 'verify_max_stock',
	            idProduct: idProduct,
	            quantity: quantity
	    	},
			success: function(result){

				if(result==1 || result==-1){
					agregar_producto(idProduct,notprice,quantity,sub_total);
					actualizar_carrito();
					if($('.buy-slide:hidden')){
						$('.buy-slide').slideDown('fast');
					}
				} else if(result == 0){
					alert('No hay existencias');
					$('.result_products').html('No hay existencias.');
					$('.result_products').css({'opacity' : '1'});
					setTimeout(function () {
						$('.result_products').css({'opacity' : '0'});
						$('.result_products').text('');
					}, 5000);
				}
			},
			error: function(error){
				alert(error);
			}
		});
	});

	function agregar_producto(idProduct,notprice,quantity,sub_total){
		// alert('Agregar Producto');
		var namefunction = "agregar_producto";
		$.ajax({
			beforeSend: function(){
				//location.reload();
			},
			url: "./php/functions_cart.php",
			type: "POST",
			data: {
				idProduct:idProduct,
				notprice:notprice,
				quantity:quantity,
				sub_total:sub_total,
				namefunction:namefunction
			},
			success: function(result){
		  		// alert(result);
			},
			error: function(error){
				alert("error");
			},
			complete: function(){
			},
			timeout: 10000
		});
	}

	function actualizar_carrito(){
		// alert('Actualizar Carrito');
		$.ajax({
          	beforeSend: function(){
          		//location.reload();
      		},
          	url: "./php/functions_cart.php",
          	type: "POST",
          	data: {
              	namefunction:'actualizar_carrito'
          	},
          	success: function(data){

          		// alert(data);
          		// $('.cart_').html(data);
          	},
          	error: function(){
          	},
          	complete: function(){
          	},
          	timeout: 10000
      	});
	}

	function actualizar_carrito_confirmar(idProduct,quantity){
		// alert('Actualizar Carrito Confirmar');
		$.ajax({
          	beforeSend: function(){
          		location.reload();
      		},
          	url: "./php/functions_cart.php",
          	type: "POST",
          	data: {
              	namefunction:'actualizar_carrito_confirmar',
              	idProduct: idProduct,
              	quantity: quantity
          	},
          	success: function(data){
          		alert('Añadido a carrito');
          		// $('.g_cart_cont').html(data);
          	},
          	error: function(){
          	},
          	complete: function(){
          	},
          	timeout: 10000
      	});

	}

	function disminuir_item_cart(idItemCart){
		// alert('Disminuir Item Cart');
		$.ajax({
          	beforeSend: function(){
          		location.reload();
      		},
          	url: "./php/functions_cart.php",
          	type: "POST",
          	data: {
          		idItemCart: idItemCart,
              	namefunction:'disminuir_item_cart'
          	},
          	success: function(data){
          		// alert(data);
          		location.reload();
          		// $('.g_cart_cont').html(data);
          	},
          	error: function(){
          	},
          	complete: function(){
          	},
          	timeout: 10000
      	});

	}

	function incrementar_item_cart(idItemCart){
		// alert('Incrementar Item Cart');
		$.ajax({
      		beforeSend: function(){
      			location.reload();
	      	},
          	url: "./php/functions_cart.php",
          	type: "POST",
          	data: {
          		idItemCart: idItemCart,
              	namefunction:'incrementar_item_cart'
          	},
          	success: function(data){
          		// alert(data);
          		location.reload();
          	},
          	error: function(){
          	},
          	complete: function(){
          	},
          	timeout: 10000
     	});

	}

})();
