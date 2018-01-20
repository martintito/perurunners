$(document).on("ready", init);// Inciamos el jquery

function init(){
	
    $('#tblSucursal').dataTable({
        dom: '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    
	ListadoSucursal();// Ni bien carga la pagina que cargue el metodo
	ComboTipo_Documento();
	$("#VerForm").hide();// Ocultamos el formulario
	$("form#frmSucursal").submit(SaveOrUpdate);// Evento submit de jquery que llamamos al metodo SaveOrUpdate para poder registrar o modificar datos
	
	$("#btnNuevo").click(VerForm);// evento click de jquery que llamamos al metodo VerForm
        
        //--------------------------------------------modal de confirmacion
    $('#submitBtnSucursal').click(function (e) {
        var campo1 = $.trim($('#txtRazon_Social').val());
        var campo2 = $.trim($('#txtNum_Documento').val());
        var campo3 = $.trim($('#txtDireccion').val());
        var campo4 = $.trim($('#txtTelefono').val());        
        // Check if empty of not
        if (campo1 === '') {
            if ($("#txtRazon_Social").parent().next(".validation").length == 0) // only add if not added
            {
                $("#txtRazon_Social").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'><b>¡La razón social es obligatoria!</b></div>");
            }
            return false;
        } else {
            $("#txtRazon_Social").parent().next(".validation").remove();
        }
        if (campo2 === '') {
            if ($("#txtNum_Documento").parent().next(".validation").length == 0) // only add if not added
            {
                $("#txtNum_Documento").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'><b>¡El nombre de documento es obligatorio!</b></div>");
            }
            return false;
        } else {
            $("#txtNum_Documento").parent().next(".validation").remove();
        }
        if (campo3 === '') {
            if ($("#txtDireccion").parent().next(".validation").length == 0) // only add if not added
            {
                $("#txtDireccion").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'><b>¡La dirección es obligatoria!</b></div>");
            }
            return false;
        } else {
            $("#txtDireccion").parent().next(".validation").remove();
        }
        if (campo4 === '') {
            if ($("#txtTelefono").parent().next(".validation").length == 0) // only add if not added
            {
                $("#txtTelefono").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'><b>¡El teléfono es obligatorio!</b></div>");
            }
            return false;
        } else {
            $("#txtTelefono").parent().next(".validation").remove();
        }
        e.preventDefault();
        var msg = '¿Está seguro de realizar esta operación?';
        bootbox.confirm(msg, function (result) {
            if (result) {
                $('#frmSucursal').submit(); //aqui llega!!!
            }
        });
    });
    //-----------------------------------------fin modal de confirmacion

	function SaveOrUpdate(e){
		e.preventDefault();

        var formData = new FormData($("#frmSucursal")[0]);

        $.ajax({

                url: "./ajax/SucursalAjax.php?op=SaveOrUpdate",

                type: "POST",

               data: formData,

                contentType: false,

                processData: false,

                success: function(datos)

                {

                    swal("Mensaje del Sistema", datos, "success");
					ListadoSucursal();
					OcultarForm();
                }

            });
	};

	function Limpiar(){
		// Limpiamos las cajas de texto
		$("#txtIdSucursal").val("");
	    $("#txtRazon_Social").val("");
	    $("#txtNum_Documento").val("");
	    $("#txtDireccion").val("");
	    $("#txtTelefono").val("");
	    $("#txtEmail").val("");
	    $("#txtRepresentante").val("");
	}

	function VerForm(){
		$("#VerForm").show();// Mostramos el formulario
		$("#btnNuevo").hide();// ocultamos el boton nuevo
		$("#VerListado").hide();
	}


	function OcultarForm(){
		$("#VerForm").hide();// Mostramos el formulario
		$("#btnNuevo").show();// ocultamos el boton nuevo
		$("#VerListado").show();
	}
}

function ListadoSucursal(){ 
        var tabla = $('#tblSucursal').dataTable();
        $.ajax({
            url: './ajax/SucursalAjax.php?op=list',
            dataType: 'json',
            success: function(s){
            //console.log(s);
                    tabla.fnClearTable();
                        for(var i = 0; i < s.length; i++) {
                         tabla.fnAddData([
                                    s[i][0],
                                    s[i][1],
                                    s[i][2],
                                    s[i][3],
                                    s[i][4],
                                    s[i][5],
                                    s[i][6],
                                    s[i][7]
                                      ]);                                       
                        } // End For
                                        
            },
            error: function(e){
               console.log(e.responseText); 
            }
        });
    };

function eliminarSucursal(id){// funcion que llamamos del archivo ajax/CategoriaAjax.php?op=delete linea 53
	bootbox.confirm("¿Esta Seguro de eliminar la Sucursal?", function(result){ // confirmamos con una pregunta si queremos eliminar
		if(result){// si el result es true
			$.post("./ajax/SucursalAjax.php?op=delete", {id : id}, function(e){// llamamos la url de eliminar por post. y mandamos por parametro el id 
                swal("Mensaje del Sistema", e, "success");
				ListadoSucursal();

            });
		}
		
	})
}

function cargarDataSucursal(id, razon_social,tipo_documento,num_documento,direccion,telefono,email,representante,logo,estado){// funcion que llamamos del archivo ajax/CategoriaAjax.php linea 52
		$("#VerForm").show();// mostramos el formulario
		$("#btnNuevo").hide();// ocultamos el boton nuevo
		$("#VerListado").hide();// ocultamos el listado

		$("#txtIdSucursal").val(id);// recibimos la variable id a la caja de texto txtIdCategoria
	    $("#txtRazon_Social").val(razon_social);
 		$("#cboTipo_Documento").val(tipo_documento);
 		$("#txtNum_Documento").val(num_documento);
 		$("#txtDireccion").val(direccion);
 		$("#txtTelefono").val(telefono);
 		$("#txtEmail").val(email);
 		$("#txtRepresentante").val(representante);
 		//$("#txtLogo").val(logo);
 		$("#txtRutaImgSuc").val(logo);
	    $("#txtRutaImgSuc").show();
 		$("#txtEstado").val(estado);
 	}	


 	function ComboTipo_Documento() {

        $.get("./ajax/SucursalAjax.php?op=listTipo_DocumentoPersona", function(r) {
                $("#cboTipo_Documento").html(r);
            
        })
    }
