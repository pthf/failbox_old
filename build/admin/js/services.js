
	$("#formProduct").submit(function(e){

		e.preventDefault();

		var ajaxData = new FormData();
		ajaxData.append("action", $(this).serialize());
		ajaxData.append("namefunction", "addNewProduct");

		$.ajax({
			//url: "../class/functions.php",
			url: "../php/functions.php",
			type: "POST",
			data: ajaxData,
			processData: false,
			contentType: false,
			success: function(result){
				//alert(result);
				 var id = result;
				 window.location.href = "../create/createProducts.php?id="+id;
			},
			error: function(error){
				alert(error);
			}
		})
	})

	$("#formCharacteristics").submit(function(e){

		e.preventDefault();

		var ajaxData = new FormData();
		ajaxData.append("action", $(this).serialize());
		ajaxData.append("namefunction", "addNewCharacteristics");

		$.ajax({
			url: "../php/functions.php",
			type: "POST",
			data: ajaxData,
			processData: false,
			contentType: false,
			success: function(result){
				//alert(result);
				 var id = result;
				 window.location.href = "../create/createProducts.php?id="+id;
			},
			error: function(error){
				alert(error);
			}
		})
	})


	$("#formEditProduct").submit(function(e){

		e.preventDefault();

		var ajaxData = new FormData();
		ajaxData.append("action", $(this).serialize());
		ajaxData.append("namefunction", "editProduct");

		$.ajax({
			url: "../php/functions.php",
			type: "POST",
			data: ajaxData,
			processData: false,
			contentType: false,
			success: function(result){
				var id = result;
				window.location.href = "../create/createCharacteristics.php?id="+id;
			},
			error: function(error){
				alert(error);
			}
		})
	})

	$("#formNewSubcategory").submit(function(e){

		e.preventDefault();

		var ajaxData = new FormData();
		ajaxData.append("action", $(this).serialize());
		ajaxData.append("namefunction", "addNewSubcategory");

		$.ajax({
			//url: "../class/functions.php",
			url: "../php/functions.php",
			type: "POST",
			data: ajaxData,
			processData: false,
			contentType: false,
			success: function(result){
				//location.reload();
				$('.result_subcategory').html(result);
				$('.result_subcategory').hide(4000);
				$('#formNewSubcategory')[0].reset();
			},
			error: function(error){
				alert(error);
			}
		})
	})

	$("#insertBannerImage").submit(function(e){

		e.preventDefault();

		var ajaxData = new FormData();
		ajaxData.append("action", $(this).serialize());
		ajaxData.append("namefunction", "addImageBanner");

		$.each($("input[type=file]"), function(i, obj) {
			$.each(obj.files, function(j,file) {
				ajaxData.append('failboxBannerImage['+i+']', file);
			})
		});

		$.ajax({
			url: "../php/functions.php",
			type: "POST",
			data: ajaxData,
			processData: false,
			contentType: false,
			success: function(result){
				location.reload();
			},
			error: function(error){
				alert(error);
			}
		})
	});