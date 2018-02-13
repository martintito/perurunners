$(document).on("ready", init);// Inciamos el jquery

function init(){
	
    $('#tblTipo_Pago').dataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    
	ListadoTipo_Pago();// Ni bien carga la pagina que cargue el metodo
	$("#VerForm").hide();// Ocultamos el formulario
	$("form#frmTipo_Pago").submit(SaveOrUpdate);// Evento submit de jquery que llamamos al metodo SaveOrUpdate para poder registrar o modificar datos
	
	$("#btnNuevo").click(VerForm);// evento click de jquery que llamamos al metodo VerForm

         //--------------------------------------------modal de confirmacion
        $('#submitBtnTipoPago').click(function (e) {
            var name = $.trim($('#txtNombre').val());
            var monto = $.trim($('#txtMonto').val());
            // Check if empty of not
            if (name === '') {
                if ($("#txtNombre").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#txtNombre").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'><b>¡La descripción del tipo de pago es obligatoria!</b></div>");
                }
                return false;
            } else {
                $("#txtNombre").parent().next(".validation").remove();
            }
            if (monto === '') {
                if ($("#txtMonto").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#txtMonto").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'><b>¡El monto del tipo de pago es obligatorio!</b></div>");
                }
                return false;
            } else {
                $("#txtMonto").parent().next(".validation").remove();
            }
            e.preventDefault();
            var msg = '¿Está seguro de realizar esta operación?';
            bootbox.confirm(msg, function (result) {
                if (result) {
                    $('#frmTipo_Pago').submit(); //aqui llega!!!
                }
            });
        });
        //-----------------------------------------fin modal de confirmacion

	function SaveOrUpdate(e){
		e.preventDefault();// para que no se recargue la pagina
        $.post("./ajax/Tipo_PagoAjax.php?op=SaveOrUpdate", 
			$(this).serialize(), function(r){// llamamos la url por post. function(r). r-> llamada del callback
            swal("Mensaje del Sistema", r, "success");// mostramos el mensaje del callback
            Limpiar();// llamamos al metodod Limpiar
            ListadoTipo_Pago();
            OcultarForm();
        });
	};

	function Limpiar(){
		// Limpiamos las cajas de texto
		$("#txtIdTipo_Pago").val("");
	    $("#txtNombre").val("");
		$("#cboMoneda").val("");
	    $("#txtMonto").val("");
	}

	function VerForm(){
		$("#VerForm").show();// Mostramos el formulario
		$("#btnNuevo").hide();// ocultamos el boton nuevo
		$("#VerListado").hide();
	}

	function OcultarForm(){
        $("#VerForm").hide();
        $("#btnNuevo").show();
        $("#VerListado").show();
    }
    
}

function ListadoTipo_Pago(){ 
         var tabla = $('#tblTipo_Pago').dataTable();
        $.ajax({
            url: './ajax/Tipo_PagoAjax.php?op=list',
            dataType: 'json',
            success: function(s){
            console.log(s);
                    tabla.fnClearTable();
                        for(var i = 0; i < s.length; i++) {
                         tabla.fnAddData([
                                    s[i][0],
                                    s[i][1],
                                    s[i][2],
                                    s[i][3],
                                    s[i][4]
									//s[i][5]
                                      ]);                                       
                        } // End For
                                        
            },
            error: function(e){
               console.log(e.responseText); 
            }
        });
    };

function eliminarTipo_Pago(id){// funcion que llamamos del archivo ajax/CategoriaAjax.php?op=delete linea 53
	bootbox.confirm("¿Esta Seguro de eliminar el tipo de documento?", function(result){ // confirmamos con una pregunta si queremos eliminar
		if(result){// si el result es true
			$.post("./ajax/Tipo_PagoAjax.php?op=delete", {id : id}, function(e){// llamamos la url de eliminar por post. y mandamos por parametro el id 
                swal("Mensaje del Sistema", e, "success");
				ListadoTipo_Pago();

            });
		}
		
	})
}

function cargarDataTipo_Pago(id,nombre,moneda,monto){// funcion que llamamos del archivo ajax/CategoriaAjax.php linea 52
		$("#VerForm").show();// mostramos el formulario
		$("#btnNuevo").hide();// ocultamos el boton nuevo
		$("#VerListado").hide();

		$("#txtIdTipo_Pago").val(id);
	    $("#txtNombre").val(nombre);
	    $("#txtMonto").val(monto);
		$("#cboMoneda").val(moneda);
}