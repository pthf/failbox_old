
	$("#formProduct").submit(function(e){

		e.preventDefault();

		var ajaxData = new FormData();
		ajaxData.append("action", $(this).serialize());
		ajaxData.append("namefunction", "addNewProduct");

		/*$.each($("input[type=file]"), function(i, obj) {
			$.each(obj.files, function(j,file) {
				ajaxData.append('images['+i+']', file);
			})
		});*/

		$.ajax({
			url: "../class/functions.php",
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
	})


	$("#formEditProduct").submit(function(e){

		e.preventDefault();

		var ajaxData = new FormData();
		ajaxData.append("action", $(this).serialize());
		ajaxData.append("namefunction", "editProduct");

		/*$.each($("input[type=file]"), function(i, obj) {
			$.each(obj.files, function(j,file) {
				ajaxData.append('images['+i+']', file);
			})
		});*/

		$.ajax({
			url: "../class/functionEdit.php",
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
	})