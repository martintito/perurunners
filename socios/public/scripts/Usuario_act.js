$(document).on("ready", init);
function init(){

	$("form#form_socio").submit(SaveOrUpdate);
	function SaveOrUpdate(e){
		
		e.preventDefault();

        var formData = new FormData($("#form_socio")[0]);

        $.ajax({
            url: "http://www.perurunners.com/intranet/ajax/SocioAjax.php?op=SaveOrUpdate3",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos)
            {
				//alert('activar 4'); 
			   //$(location).attr("href", "index.html");
			   //swal("Mensaje del Sistema", datos, "success");
			   alert("Gracias por Ser Nuevo Socio.\nInice nuevamente sesion: \nTu nombre de usuario es: "+$("#nombre_usuario").val()+"\nTu clave secreta es: "+$("#clave_nueva").val());
               $(location).attr("href", "http://www.perurunners.com/intranet/ajax/UsuarioAjax.php?op=Salir");
			},
			
			error : function(datos) {
				alert('error'); 
				swal("Mensaje del Sistema", datos, "error");
				//$(location).attr("href", "inscripcion_socio.php");
			}
			
        });
	};

}