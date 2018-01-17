$(document).on("ready", init);// Inciamos el jquery

function init(){
	
	$('#tblPagos').dataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    
	ListadoPagos();
	ComboTipo_Pagos();
	$("form#frmPagos").submit(SaveOrUpdate);
	
	$("#btnNuevo").click(VerForm);
	$("#btnBuscarSocio").click(AbrirModalSocio);
	
	$("#cboTipo_Pago").on("change",function(e){
		e.preventDefault();
        $.ajax({
                url: "./ajax/PagoAjax.php?op=listar_Monto_Pago",
                type: "POST",
                data: {opcion:$(this).val()},
                success: function(r)
                {
                    $("#txtMonto").val(r);
					//$("#txtMonto_Pago").val(r);
                }
        });
	}).change(); 
	
	
	/*
	$("#cboTipo_Pago").on("change",function(e){
		e.preventDefault();
        $.ajax({
                url: "./ajax/PagoAjax.php?op=listar_Monto_Pago",
                type: "POST",
                data: {opcion:$(this).val()},
                success: function(data)
                {
					var r = data;
                    $("#txtMonto").val(r[1]);
					$("#txtMonto_Pago").val(r[0]);
                }
        });
		$.ajax({
                url: "./ajax/PagoAjax.php?op=listar_Monto_Pago2",
                type: "POST",
                data: {opcion:$(this).val()},
                success: function(r)
                {
                    //$("#txtMonto").val(r);
					$("#txtMonto_Pago").val(r);
                }
        });
	}).change(); */
    
    //--------------------------------------------modal de confirmacion
        $('#submitBtnPagos').click(function (e) {
            var campo1 = $.trim($('#txtSocio').val());
            var campo2 = $.trim($('#txtMonto').val());
            // Check if empty of not
            if (campo1 === '') {
                if ($("#txtSocio").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#txtSocio").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'><b>¡El nombre del socio es obligatorio!</b></div>");
                }
                return false;
            } else {
                $("#txtSocio").parent().next(".validation").remove();
            }
            if (campo2 === '') {
                if ($("#txtMonto").parent().next(".validation").length == 0) // only add if not added
                {
                    $("#txtMonto").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'><b>¡El monto es obligatorio!</b></div>");
                }
                return false;
            } else {
                $("#txtMonto").parent().next(".validation").remove();
            }            
            e.preventDefault();
            var msg = '¿Está seguro de realizar esta operación?';
            bootbox.confirm(msg, function (result) {
                if (result) {
                    $('#frmPagos').submit(); //aqui llega!!!
                }
            });
        });
        //-----------------------------------------fin modal de confirmacion
	
	function SaveOrUpdate(e){
		e.preventDefault();
	/*	alert($("#txtIdSocio").val());
		alert($("#txtIdUsuario").val());
		alert($("#txtMonto").val());
		alert($("#txtFecha_Pago").val());
		alert($("#cboTipo_Pago").val());*/
        var formData = new FormData($("#frmPagos")[0]);

        $.ajax({
                url: "./ajax/PagoAjax.php?op=SaveOrUpdate",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
					
                    swal("Mensaje del Sistema", datos, "success");
                    ListadoPagos();
                    OcultarForm();
                    //Limpiar();
                }
            });
	};

	function Limpiar(){
		// Limpiamos las cajas de texto
		$("#txtIdSocio").val("");
	    $("#txtSocio").val("");
	    $("#txtMonto").val("");
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
	function AbrirModalSocio(){
		$("#modalListadoSocio").modal("show");

		$.post("./ajax/SocioAjax.php?op=listarSocio", function(r){
            $("#Socio").html(r);
            $("#tblSocios").DataTable();
        });
	}
	$("#btnAgregarSocio").click(function(e){
		e.preventDefault();

		var opt = $("input[type=radio]:checked");
		$("#txtIdSocio").val(opt.val());
		$("#txtSocio").val(opt.attr("data-nombre"));
        email = opt.attr("data-email");

		$("#modalListadoSocio").modal("hide");
	});
	
}

function ListadoPagos(){ 
	var tabla = $('#tblPagos').dataTable(
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
                    {"mDataProp": "7"}
        	],"ajax": 
	        	{
	        		url: './ajax/PagoAjax.php?op=list',
					type : "get",
					dataType : "json",
					
					error: function(e){
				   		console.log(e.responseText);	
					}
	        	},
	        "bDestroy": true

    	}).DataTable();
    }
function ComboTipo_Pagos() {

        $.get("./ajax/PagoAjax.php?op=listar_Tipo_Pagos", function(r) {
                $("#cboTipo_Pago").html(r);
            
        })
}

