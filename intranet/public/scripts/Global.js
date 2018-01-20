$(document).on("ready", init);// Inciamos el jquery

function init(){
	
	$('#tblGlobal').dataTable({
        dom: '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    
	ListadoGlobal();// Ni bien carga la pagina que cargue el metodo
	$("#VerForm").hide();// Ocultamos el formulario
	$("form#frmGlobal").submit(SaveOrUpdate);// Evento submit de jquery que llamamos al metodo SaveOrUpdate para poder registrar o modificar datos
	
	$("#btnNuevo").click(VerForm);// evento click de jquery que llamamos al metodo VerForm
        
        //--------------------------------------------modal de confirmacion
    $('#submitBtnGlobal').click(function (e) {
        var nombreEmpresa = $.trim($('#txtEmpresa').val());
        var nombreImpuesto = $.trim($('#txtNombre_Impuesto').val());
        var porcentajeImpuesto = $.trim($('#txtPorcentaje_Impuesto').val());
        var simboloMoneda = $.trim($('#txtSimbolo_Moneda').val());
        var imagenGlobal = $.trim($('#imagenGlobal').val());
        // Check if empty of not
        if (nombreEmpresa === '') {
            if ($("#txtEmpresa").parent().next(".validation").length == 0) // only add if not added
            {
                $("#txtEmpresa").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'><b>¡El nombre de empresa es obligatorio!</b></div>");
            }
            return false;
        } else {
            $("#txtEmpresa").parent().next(".validation").remove();
        }
        if (nombreImpuesto === '') {
            if ($("#txtNombre_Impuesto").parent().next(".validation").length == 0) // only add if not added
            {
                $("#txtNombre_Impuesto").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'><b>¡El nombre de impuesto es obligatorio!</b></div>");
            }
            return false;
        } else {
            $("#txtNombre_Impuesto").parent().next(".validation").remove();
        }
        if (porcentajeImpuesto === '') {
            if ($("#txtPorcentaje_Impuesto").parent().next(".validation").length == 0) // only add if not added
            {
                $("#txtPorcentaje_Impuesto").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'><b>¡El porcentaje de impuesto es obligatorio!</b></div>");
            }
            return false;
        } else {
            $("#txtPorcentaje_Impuesto").parent().next(".validation").remove();
        }
        if (simboloMoneda === '') {
            if ($("#txtSimbolo_Moneda").parent().next(".validation").length == 0) // only add if not added
            {
                $("#txtSimbolo_Moneda").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'><b>¡El símbolo de la moneda es obligatorio!</b></div>");
            }
            return false;
        } else {
            $("#txtSimbolo_Moneda").parent().next(".validation").remove();
        }
        e.preventDefault();
        var msg = '¿Está seguro de realizar esta operación?';
        bootbox.confirm(msg, function (result) {
            if (result) {
                $('#frmGlobal').submit(); //aqui llega!!!
            }
        });
    });
    //-----------------------------------------fin modal de confirmacion

	function SaveOrUpdate(e){
			e.preventDefault();

	        var formData = new FormData($("#frmGlobal")[0]);

	        $.ajax({

	                url: "./ajax/GlobalAjax.php?op=SaveOrUpdate",

	                type: "POST",

	               data: formData,

	                contentType: false,

	                processData: false,

	                success: function(datos)

	                {

	                    swal("Mensaje del Sistema", datos, "success");
	                    ListadoGlobal();
	                    OcultarForm();
	                    Limpiar();
	                }

	            });
	};

	function Limpiar(){
			// Limpiamos las cajas de texto
			$("#txtIdGlobal").val("");
		    $("#txtEmpresa").val("");
		    $("#txtNombre_Impuesto").val("");
		    $("#txtPorcentaje_Impuesto").val("");
		    $("#txtSimbolo_Moneda").val("");
		    $("#txtRutaImgLogo").val("");
		    $("#imagenGlobal").val("");
	}

	function VerForm(){
			$("#VerForm").show();// Mostramos el formulario
			$("#btnNuevo").hide();// ocultamos el boton nuevo
			$("#VerListado").hide();// ocultamos el listado
	}
	function OcultarForm(){
			$("#VerForm").hide();// Mostramos el formulario
			$("#btnNuevo").show();// ocultamos el boton nuevo
			$("#VerListado").show();// ocultamos el listado
	}
}
function ListadoGlobal(){ 
        var tabla = $('#tblGlobal').dataTable();
         $.ajax({
			url: './ajax/GlobalAjax.php?op=list',
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

function eliminarGlobal(id){// funcion que llamamos del archivo ajax/CategoriaAjax.php?op=delete linea 53
	bootbox.confirm("¿Esta Seguro de eliminar la Configuración?", function(result){ // confirmamos con una pregunta si queremos eliminar
		if(result){// si el result es true
			$.post("./ajax/GlobalAjax.php?op=delete", {id : id}, function(e){// llamamos la url de eliminar por post. y mandamos por parametro el id 
                
				swal("Mensaje del Sistema", e, "success");
                ListadoGlobal();

            });
		}
		
	})
}

function cargarDataGlobal(id, empresa,nombre_impuesto,porcentaje_impuesto,simbolo_moneda, logo){// funcion que llamamos del archivo ajax/CategoriaAjax.php linea 52
		$("#VerForm").show();// mostramos el formulario
		$("#btnNuevo").hide();// ocultamos el boton nuevo
		$("#VerListado").hide();// ocultamos el listado
		$("#txtIdGlobal").val(id);// recibimos la variable id a la caja de texto txtIdCategoria
	    $("#txtEmpresa").val(empresa);
	    $("#txtNombre_Impuesto").val(nombre_impuesto);
	    $("#txtPorcentaje_Impuesto").val(porcentaje_impuesto);
	    $("#txtSimbolo_Moneda").val(simbolo_moneda);
	    $("#txtRutaImgLogo").val(logo);
	    $("#txtRutaImgLogo").show();
}