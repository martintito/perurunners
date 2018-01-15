$(document).on("ready", init);



function init() {

    var tabla = $('#tblArticulos').dataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });

    ListadoArticulos();
    ComboCategoria();
    ComboUM();
    $("#VerForm").hide();
    $("#txtRutaImgArt").hide();
    $("form#frmArticulos").submit(SaveOrUpdate);

    $("#btnNuevo").click(VerForm);





//--------------------------------------------modal

$('#submitBtn').click(function(e) {
    
    var name = $.trim($('#txtNombre').val());
    //var desc = $.trim($('#txtDescripcion').val());
    

    // Check if empty of not
    if (name === '') {
        //alert('Text-field is empty.');
        if ($("#txtNombre").parent().next(".validation").length == 0) // only add if not added
            {
                $("#txtNombre").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'><b>¡El nombre de artículo es obligatorio!</b></div>");
            }
        return false;
    }else{
        $("#txtNombre").parent().next(".validation").remove();
    }
//    if (desc === '') {
//        if ($("#txtDescripcion").parent().next(".validation").length == 0) // only add if not added
//            {
//                $("#txtDescripcion").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Completa este campo</div>");
//            }
//        return false;
//    }else{
//        $("#txtDescripcion").parent().next(".validation").remove();
//    }
    
    e.preventDefault();
    var msg = '¿Está seguro de registrar este articulo?';
    bootbox.confirm(msg, function(result) {
        if (result) {
            $('#frmArticulos').submit(); //aqui llega!!!
        }
    });
});



//
//$('#frmArticulos').submit(function(e) {
//        var currentForm = this;
//        e.preventDefault();
//        bootbox.confirm("Are you sure?", function(result) {
//            if (result) {
//                currentForm.submit();
//            }
//        });
//    });

//----------------------------------------fin modal

    function SaveOrUpdate(e) {
        e.preventDefault();

        var formData = new FormData($("#frmArticulos")[0]);

        $.ajax({
            url: "./ajax/ArticuloAjax.php?op=SaveOrUpdate",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (datos)

            {

                swal("Mensaje del Sistema", datos, "success");
                ListadoArticulos();
                OcultarForm();
                $('#frmArticulos').trigger("reset");
            }

        });
    }
    ;

    function ComboCategoria() {
        $.post("./ajax/ArticuloAjax.php?op=listCategoria", function (r) {
            $("#cboCategoria").html(r);
        });
    }

    function ComboUM() {
        $.post("./ajax/ArticuloAjax.php?op=listUM", function (r) {
            $("#cboUnidadMedida").html(r);
        });
    }

    function Limpiar() {
        $("#txtIdArticulo").val("");
        $("#txtNombre").val("");
    }

    function VerForm() {
        $("#VerForm").show();
        $("#btnNuevo").hide();
        $("#VerListado").hide();
    }

    function OcultarForm() {
        $("#VerForm").hide();// Mostramos el formulario
        $("#btnNuevo").show();// ocultamos el boton nuevo
        $("#VerListado").show();
    }
}
function ListadoArticulos() {
    var tabla = $('#tblArticulos').dataTable(
            {"aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                "aoColumns": [
                    {"mDataProp": "id"},
                    {"mDataProp": "1"},
                    {"mDataProp": "2"},
                    {"mDataProp": "3"},
                    {"mDataProp": "4"},
                    {"mDataProp": "5"},
                    {"mDataProp": "6"},
                    {"mDataProp": "7"},
                    {"mDataProp": "8"},
                    {"mDataProp": "9"},
                    {"mDataProp": "10"}

                ], "ajax":
                        {
                            url: './ajax/ArticuloAjax.php?op=list',
                            type: "get",
                            dataType: "json",
                            error: function (e) {
                                console.log(e.responseText);
                            }
                        },
                "bDestroy": true

            }).DataTable();

}
;
function eliminarArticulo(id) {
    bootbox.confirm("¿Esta seguro de eliminar el artículo?", function (result) {
        if (result) {
            $.post("./ajax/ArticuloAjax.php?op=delete", {id: id}, function (e) {

                swal("Mensaje del Sistema", e, "success");
                ListadoArticulos();

            });
        }

    })
}

//function registrarArticulo() {
//    $('#frmArticulos').submit();
//}



function cargarDataArticulo(idarticulo, idcategoria, idunidad_medida, nombre, descripcion, imagen) {
    $("#VerForm").show();
    $("#btnNuevo").hide();
    $("#VerListado").hide();

    $("#txtIdArticulo").val(idarticulo);
    $("#cboCategoria").val(idcategoria);
    $("#cboUnidadMedida").val(idunidad_medida);
    $("#txtNombre").val(nombre);
    $("#txtDescripcion").val(descripcion);
    // $("#imagenArt").val(imagen);
    $("#txtRutaImgArt").val(imagen);
    $("#txtRutaImgArt").show();
    //$("#txtRutaImgArt").prop("disabled", true);
}