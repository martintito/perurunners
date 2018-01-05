$(document).on("ready", init);// Inciamos el jquery
//alert('activar 1'); 
//alert($('input:radio[name=discapacidad]:checked').val());
function init(){
	/* if($("#discapacidad").is(':checked')) {  
            alert("Está activado");  
        } else {  
            alert("No está activado");  
        }  */
	ComboTipo_Documento();
	Combo_Distritos();
	//Combo_Sedes();
	Combo_Paises();
	//Combo_Bancos();
	/*
	$("#tipo_discapacidad").hide();
	$("#nombre_club").hide();
	$("#radio1").on("change",function(e){
		e.preventDefault();
		//alert('activar 1'); 
		$("#tipo_discapacidad").hide();
		//$("#tipo_discapacidad").val('');
	});
	$("#radio2").on("change",function(e){
		e.preventDefault();
		//alert('activar 2'); 
		$("#tipo_discapacidad").show();
		$("#tipo_discapacidad").focus();
	}); 
	$("#club1").on("change",function(e){
		e.preventDefault();
		//alert('activar 1'); 
		$("#nombre_club").hide();
		$("#nombre_club").val('');
	});
	$("#club2").on("change",function(e){
		e.preventDefault();
		//alert('activar 2'); 
		$("#nombre_club").show();
		$("#nombre_club").focus();
	});
	//alert($('input:radio[name=discapacidad]:checked').val());
	*/
}

 	function ComboTipo_Documento() {

        $.get("./ajax/EmpleadoAjax.php?op=listTipo_DocumentoPersona", function(r) {
                $("#cboTipo_Documento").html(r);
            
        })
    }
	function Combo_Distritos() {

        $.get("./ajax/SocioAjax.php?op=listar_Distritos", function(r) {
                $("#distrito").html(r);
            
        })
    }
	function Combo_Sedes() {

        $.get("./ajax/SocioAjax.php?op=listar_Sedes", function(r) {
                $("#sede").html(r);
            
        })
    }
	function Combo_Paises() {

        $.get("./ajax/SocioAjax.php?op=listar_Paises", function(r) {
                $("#pais").html(r);
            
        })
    }
	function Combo_Bancos() {

        $.get("./ajax/SocioAjax.php?op=listar_Bancos", function(r) {
                $("#banco").html(r);
            
        })
    }