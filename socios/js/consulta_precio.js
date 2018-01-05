		$("#guardar_datos" ).submit(function() {
		var mensaje=$("#mensaje").val();//mensaje
		var nombres=$("#nombres").val();//nombres
		var telefono=$("#telefono").val();//nombres
		var email=$("#email").val();//email
		var cantidad=$("#cantidad").val();//cantidad
		var id_producto=$("#id_producto").val();//id_producto
		
		/*Inicia validacion*/
		if (mensaje=="")
		{
		alert("Ingresa el mensaje");
		$("#mensaje").focus();
		return false;
		}
		if (nombres=="")
		{
		alert("Ingresa tu nombre");
		$("#nombres").focus();
		return false;
		}
		if (email=="")
		{
		alert("Ingresa tu email");
		$("#email").focus();
		return false;
		}
		  /*Finaliza validacion*/
		  var parametros = {"mensaje" : mensaje,"nombres" : nombres, "email": email,"cantidad":cantidad,"id_producto":id_producto,"telefono":telefono};
		  $.ajax({
				type: "POST",
				url: "envio_precio.php",
				data: parametros,
				 beforeSend: function(objeto){
					 $('#resultados_ajax').html('<div><img src="images/ajax-loader.gif"/></div>');
					
				  },
				success: function(datos){
				$("#resultados_ajax").html(datos);
				
			  }
		});
			return false;
		})
