$(document).on("ready", init);
//alert('activar 3'); 
//alert($('input:radio[name=discapacidad]:checked').val());
function init(){
	/*$("#radio1").on("change",function(e){
		e.preventDefault();
		alert('activar 1'); 
		$("#rpta").hide();
		$("#rpta").val('');
	}); 
	$("#radio2").on("change",function(e){
		e.preventDefault();
		alert('activar 2'); 
		$("#rpta").show();
		$("#rpta").focus();
	}); */
	$("form#form_socio").submit(SaveOrUpdate);
	function SaveOrUpdate(e){
		
		e.preventDefault();

        var formData = new FormData($("#form_socio")[0]);

        $.ajax({
            url: "http://localhost:81/perurunners.com.pe/intranet/ajax/SocioAjax.php?op=SaveOrUpdate",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos)
            {
				//alert('activar 4'); 
			   //$(location).attr("href", "index.html");
			   //swal("Mensaje del Sistema", datos, "success");
			   alert("Gracias "+$("#nombre").val()+" por Actualizar tus datos.\nInice su nueva sesion: \nTu nombre de usuario es: "+$("#num_doc").val()+"\nTu clave secreta es: "+$("#num_doc").val());
               $(location).attr("href", "http://localhost:81/perurunners.com.pe/intranet/ajax/UsuarioAjax.php?op=Salir");
			},
			
			error : function(datos) {
				alert('error'); 
				//swal("Mensaje del Sistema", datos, "error");
				//$(location).attr("href", "inscripcion_socio.php");
			}
			
        });
	};

}