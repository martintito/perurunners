$(document).on("ready", init);

function init(){

	$("form#form_socio").submit(SaveOrUpdate);
	
	function SaveOrUpdate(e){
		
		e.preventDefault();

        var formData = new FormData($("#form_socio")[0]);
		if($("#email").val() != $("#email2").val()){
			alert('El correo ingresado debe ser igual al segundo correo');
			$("#email2").focus();
			$("#email2").css({'background-color' : '#F6CEE3'});
			return false;
		}else{
			$.ajax({
				url: "./ajax/SocioAjax.php?op=SaveOrUpdate",
				type: "POST",
				data: formData,
				contentType: false,
				processData: false,
				success: function(datos)
				{
				   //$(location).attr("href", "index.html");
				   //swal("Mensaje del Sistema", datos, "success");
				   alert("Gracias "+$("#nombre").val()+" por registrarse \nTu nombre de usuario es: "+$("#num_doc").val()+"\nTu clave secreta es: "+$("#num_doc").val());
				   $(location).attr("href", "login.html");
				},
				
				error : function(datos) {
					swal("Mensaje del Sistema", datos, "error");
					//$(location).attr("href", "inscripcion_socio.php");
				}
				
			});
		}
	};
}