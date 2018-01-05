$(document).on("ready", init);// Inciamos el jquery

function init(){
	
	$('#tblSocio').dataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    
	ListadoSocio();// Ni bien carga la pagina que cargue el metodo
	ComboTipo_Documento();
	ComboTipo_Sedes();
	ComboTipo_Distritos();
	ComboTipo_Membresias();
	ComboBancos();
	ComboPaises();
	//$("#VerForm").hide();// Ocultamos el formulario
	//$("#txtClaveOtro").hide();
	$("form#frmSocio").submit(SaveOrUpdate);// Evento submit de jquery que llamamos al metodo SaveOrUpdate para poder registrar o modificar datos
	
	$("#btnNuevo").click(VerForm);// evento click de jquery que llamamos al metodo VerForm

	function SaveOrUpdate(e){
		e.preventDefault();

        var formData = new FormData($("#frmSocio")[0]);

        $.ajax({
                url: "./ajax/SocioAjax.php?op=SaveOrUpdate2",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                    swal("Mensaje del Sistema", datos, "success");
                    ListadoSocio();
                    OcultarForm();
                    Limpiar();
                }
            });
	};

	function Limpiar(){
		// Limpiamos las cajas de texto
		$("#txtIdSocio").val("");
	    $("#txtNombres").val("");
	    $("#txtApe_pat").val("");
		$("#txtApe_mat").val("");
	    $("#txtNum_Documento").val("");
	    $("#txtDireccion").val("");
	    $("#txtTelefono").val("");
	    $("#txtEmail").val("");
	    //$("#txtRepresentante").val("");
	    $("#txtLogin").val("");
	    $("#txtClave").val("");
	    //$("#txtClaveOtro").val("");
	}

	function VerForm(){
		$("#VerForm").show();// Mostramos el formulario
		$("#btnNuevo").hide();
		$("#VerListado").hide();// ocultamos el listado
	}

	function OcultarForm(){
		$("#VerForm").hide();// Mostramos el formulario
		$("#btnNuevo").show();// ocultamos el boton nuevo
		$("#VerListado").show();
	}
}

function ListadoSocio(){ 
	var tabla = $('#tblSocio').dataTable(
		{   "aProcessing": true,
       		"aServerSide": true,
   			dom: 'Bfrtip',
	        buttons: [
	            'copyHtml5',
	            'excelHtml5',
	            'csvHtml5',
	            'pdfHtml5'
	        ],
        	"aoColumns":[
        	     	{"mDataProp": "0"},
                    {"mDataProp": "1"},
                    {"mDataProp": "2"},
                    {"mDataProp": "3"},
                    {"mDataProp": "4"},
                    {"mDataProp": "5"},
                    {"mDataProp": "6"},
                    {"mDataProp": "7"},
                    {"mDataProp": "8"},
					{"mDataProp": "9"},
					{"mDataProp": "10"},
					{"mDataProp": "11"},
					{"mDataProp": "12"},
					{"mDataProp": "13"}
        	],"ajax": 
	        	{
	        		url: './ajax/SocioAjax.php?op=list',
					type : "get",
					dataType : "json",
					
					error: function(e){
				   		console.log(e.responseText);	
					}
	        	},
	        "bDestroy": true

    	}).DataTable();
    };

function eliminarSocio(id){
	bootbox.confirm("¿Esta Seguro de eliminar el Socio?", function(result){
		if(result){// si el result es true
			$.post("./ajax/SocioAjax.php?op=delete", {id : id}, function(e){
                swal("Mensaje del Sistema", e, "success");
				ListadoEmpleado();

            });
		}
		
	})
}

function cargarDataSocio(idsocio,ape_pat,ape_mat,nombres,tipo_doc,num_doc,direccion,telef_fijo,telef_celu,est_civil,email,fecha_nac,genero,talla_polo,talla_zapa,correrxsem,discapacidad,miembro_club,nom_contacto,telef_contacto,tipo_tarjeta,num_tarjeta,id_pais,id_sede,id_dist,id_memb,id_banco,login, clave,estado){
		$("#VerForm").show();
		$("#btnNuevo").hide();
		$("#VerListado").hide();

		$("#txtIdSocio").val(idsocio);
	    $("#txtApe_pat").val(ape_pat);
		$("#txtApe_mat").val(ape_mat);
	    $("#txtNombres").val(nombres);
 		$("#cboTipo_Documento").val(tipo_doc);
		$("#txtNum_Documento").val(num_doc);
		
		$("#txtDireccion").val(direccion);
		$("#txtTelefono").val(telef_fijo);
		$("#txtCelular").val(telef_celu);
		$("#txtEstado_civil").val(est_civil);
		$("#txtEmail").val(email);
 		$("#txtFecha_Nacimiento").val(fecha_nac);
		
		$("#txtGenero").val(genero);
		$("#txtPolo").val(talla_polo);
		$("#txtZapatilla").val(talla_zapa);
		$("#txtCorre").val(correrxsem);
		$("#txtDiscapacidad").val(discapacidad);		
	    $("#txtClub").val(miembro_club);
		$("#txtNombre_contacto").val(nom_contacto);
		$("#txtTelefono_contacto").val(telef_contacto);
		$("#txtTipo_tarjeta").val(tipo_tarjeta);
		$("#txtNro_tarjeta").val(num_tarjeta);
		$("#cboPaises").val(id_pais);
		$("#cboTipo_Sedes").val(id_sede);
		$("#cboTipo_Distritos").val(id_dist);
		$("#cboTipo_Membresias").val(id_memb);
		$("#cboBanco").val(id_banco);
		
		$("#txtLogin").val(login);
 		$("#txtClave").val(clave);
	    //$("#txtRutaImgEmp").show();
 		$("#txtEstado").val(estado);
 	}	


 	function ComboTipo_Documento() {

        $.get("./ajax/SocioAjax.php?op=listTipo_DocumentoPersona", function(r) {
                $("#cboTipo_Documento").html(r);
            
        })
    }
	function ComboTipo_Sedes() {

        $.get("./ajax/SocioAjax.php?op=listar_Sedes", function(r) {
                $("#cboTipo_Sedes").html(r);
            
        })
    }
	function ComboTipo_Distritos() {

        $.get("./ajax/SocioAjax.php?op=listar_Distritos", function(r) {
                $("#cboTipo_Distritos").html(r);
            
        })
    }
	function ComboTipo_Membresias() {

        $.get("./ajax/SocioAjax.php?op=listar_Membresias", function(r) {
                $("#cboTipo_Membresias").html(r);
            
        })
    }
		function ComboBancos() {

        $.get("./ajax/SocioAjax.php?op=listar_Bancos", function(r) {
                $("#cboBanco").html(r);
            
        })
    }
	function ComboPaises() {

        $.get("./ajax/SocioAjax.php?op=listar_Paises", function(r) {
                $("#cboPaises").html(r);
            
        })
    }