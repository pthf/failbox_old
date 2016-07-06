
	$("#formProduct").submit(function(){

		// e.preventDefault();
		if($("#name_product").val().length < 1) {
          	alert("El nombre es obligatorio");
          return false;
        }
        if($("#name_product").val().length < 30) {
          alert("El nombre debe tener como mínimo 30 caracteres");
          return false;
        }
        if($("#name_product").val().length > 50) {
          alert("El nombre debe tener como máximo 50 caracteres");
          return false;
        }
	        var ajaxData = new FormData();
			ajaxData.append("action", $(this).serialize());
			ajaxData.append("namefunction", "addNewProduct");

			$.ajax({
				url: "../php/functions.php",
				type: "POST",
				data: ajaxData,
				processData: false,
				contentType: false,
				success: function(result){
					// alert(result);
					var id = result;
					window.location.href = "../create/createProducts.php?id="+id;
				},
				error: function(error){
					alert(error);
				}
			})
         return false;

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


	$("#formEditProduct").submit(function(){

		// e.preventDefault();
		if($("#name_product").val().length < 1) {
          	alert("El nombre es obligatorio");
          return false;
        }
        if($("#name_product").val().length < 30) {
          alert("El nombre debe tener como mínimo 30 caracteres");
          return false;
        }
        if($("#name_product").val().length > 50) {
          alert("El nombre debe tener como máximo 50 caracteres");
          return false;
        }
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
					 //alert(result);
					var id = result;
					window.location.href = "../create/createCharacteristics.php?id="+id;
				},
				error: function(error){
					alert(error);
				}
			})
		return false;
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

	$("#formCargaProductos").submit(function(e){

		e.preventDefault();

		var ajaxData = new FormData();
		ajaxData.append("action", $(this).serialize());
		ajaxData.append("namefunction", "cargaMasivaProductos");

		$.each($("input[type=file]"), function(i, obj) {
			$.each(obj.files, function(j,file) {
				ajaxData.append('upload_products['+i+']', file);
			})
		});

		$.ajax({
			url: "../php/functions.php",
			type: "POST",
			data: ajaxData,
			processData: false,
			contentType: false,
			success: function(result){
				// alert(result);
				if (result == 0) {
					$('.result_products').html('<span style="color:red">Formato de archivo incorrecto</span>');
					$('.result_products').hide(6000);
					$('#formCargaProductos')[0].reset();
				} else {
					$('.result_products').html('<span style"color:blue;">Importacón exitosa!</span>');
					$('.result_products').hide(6000);
					$('#formCargaProductos')[0].reset();
					window.location.href = "../create/carga_masiva.php?total_ids="+result;
				};
			},
			error: function(error){
				alert(error);
			}
		})
	});

	$("#formCargaCaracteristicas").submit(function(e){

		e.preventDefault();

		var ajaxData = new FormData();
		ajaxData.append("action", $(this).serialize());
		ajaxData.append("namefunction", "cargaMasivaCaracteristicas");

		$.each($("input[type=file]"), function(i, obj) {
			$.each(obj.files, function(j,file) {
				ajaxData.append('upload_char['+i+']', file);
			})
		});

		$.ajax({
			url: "../php/functions.php",
			type: "POST",
			data: ajaxData,
			processData: false,
			contentType: false,
			success: function(result){
				// alert(result);
				$('.result_chars').html(result);
				$('.result_chars').hide(6000);
				$('#formCargaCaracteristicas')[0].reset();
			},
			error: function(error){
				alert(error);
			}
		})
	});
