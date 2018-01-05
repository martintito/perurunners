$(document).on("ready", init);

function init(){
	
	ComboTipo_Documento();
	Combo_Distritos();
	Combo_Sedes();
	Combo_Paises();
	Combo_Bancos();
	Combo_Membresias();
	
	$("#tipo_discapacidad").hide();
	$("#nombre_club").hide();
	$("#radio1").on("change",function(e){
		e.preventDefault();
		$("#tipo_discapacidad").hide();
		$("#discapa").val('');
	});
	$("#radio2").on("change",function(e){
		e.preventDefault();
		$("#tipo_discapacidad").show();
		$("#tipo_discapacidad").focus();
		$("#discapa").val($('select[id=tipo_discapacidad]').val());
	}); 
	$("#club1").on("change",function(e){
		e.preventDefault(); 
		$("#nombre_club").hide();
		$("#nombre_club").val('');
	});
	$("#club2").on("change",function(e){
		e.preventDefault();
		$("#nombre_club").show();
		$("#nombre_club").focus();
	});
	$("#tipo_discapacidad").change(function(){
            $('#discapa').val($(this).val());
	});

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
	function Combo_Membresias() {
        $.get("./ajax/SocioAjax.php?op=listar_Membresias", function(r) {
                $("#membresias").html(r);
        })
    }