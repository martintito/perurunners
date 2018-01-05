$(document).on("ready", init);
function init(){
	ComboTipo_Documento();
	Combo_Distritos();
	Combo_Sedes();
	Combo_Paises();
	Combo_Bancos();
	Combo_Membresias();
}

 	function ComboTipo_Documento() {

        $.get("../../intranet/ajax/EmpleadoAjax.php?op=listTipo_DocumentoPersona", function(r) {
                $("#cboTipo_Documento").html(r);
            
        })
    }
	function Combo_Distritos() {

        $.get("http://www.perurunners.com/intranet/ajax/SocioAjax.php?op=listar_Distritos", function(r) {
                $("#distrito").html(r);
				$("#distrito option[value="+ $("#id_distrito").val() +"]").attr("selected",true);
            
        })
    }
	function Combo_Sedes() {

        $.get("http://www.perurunners.com/intranet/ajax/SocioAjax.php?op=listar_Sedes", function(r) {
                $("#sede").html(r);
				$("#sede option[value="+ $("#id_sede").val() +"]").attr("selected",true);
        })
    }
	function Combo_Paises() {

        $.get("http://www.perurunners.com/intranet/ajax/SocioAjax.php?op=listar_Membresias", function(r) {
                $("#pais").html(r);
            
        })
    }
	function Combo_Bancos() {
		
        $.get("http://www.perurunners.com/intranet/ajax/SocioAjax.php?op=listar_Bancos", function(r) {
                $("#banco").html(r);
                $("#banco option[value="+ $("#id_banco").val() +"]").attr("selected",true);
        })
    }
	function Combo_Membresias() {
		
        $.get("http://www.perurunners.com/intranet/ajax/SocioAjax.php?op=listar_Membresias", function(r) {
                $("#membresias").html(r);
               // $("#membresias option[value="+ $("#id_memb").val() +"]").attr("selected",true);
        })
    }