$(document).on("ready", init);// Inciamos el jquery

var objC = new init();

function init() {


    var tabla = $('#tblCategorias').dataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });

    /*
     {
     "iDisplayLength": 2,
     "aLengthMenu": [10, 15, 20]
     }
     */

    ListadoCategorias();// Ni bien carga la pagina que cargue el metodo
    $("#VerForm").hide();// Ocultamos el formulario
    $("form#frmCategorias").submit(SaveOrUpdate);// Evento submit de jquery que llamamos al metodo SaveOrUpdate para poder registrar o modificar datos

    $("#btnNuevo").click(VerForm);// evento click de jquery que llamamos al metodo VerForm

    //$("#liCatRed").click(function(event) {
    //    $("#Cargar").load('view/Categoria.html');
    //  $.getScript("public/js/Categoria.js");
    //});

    //--------------------------------------------modal de confirmacion
    $('#submitBtnCategoria').click(function (e) {
        var name = $.trim($('#txtNombre').val());
        // Check if empty of not
        if (name === '') {
            if ($("#txtNombre").parent().next(".validation").length == 0) // only add if not added
            {
                $("#txtNombre").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'><b>¡El nombre de categoría es obligatorio!</b></div>");
            }
            return false;
        } else {
            $("#txtNombre").parent().next(".validation").remove();
        }
        e.preventDefault();
        var msg = '¿Está seguro de realizar esta operación?';
        bootbox.confirm(msg, function (result) {
            if (result) {
                $('#frmCategorias').submit(); //aqui llega!!!
            }
        });
    });
    //-----------------------------------------fin modal de confirmacion

    function SaveOrUpdate(e) {
        e.preventDefault();// para que no se recargue la pagina
        $.post("./ajax/CategoriaAjax.php?op=SaveOrUpdate", $(this).serialize(), function (r) {// llamamos la url por post. function(r). r-> llamada del callback

            Limpiar();
            //$.toaster({ priority : 'success', title : 'Mensaje', message : r});
            swal("Mensaje del Sistema", r, "success");
            ListadoCategorias();
            OcultarForm();

        });
    }
    ;

    function Limpiar() {
        // Limpiamos las cajas de texto
        $("#txtIdCategoria").val("");
        $("#txtNombre").val("");
    }

    function VerForm() {
        $("#VerForm").show();// Mostramos el formulario
        $("#btnNuevo").hide();// ocultamos el boton nuevo
        $("#VerListado").hide();// ocultamos el listado
    }

    function OcultarForm() {
        $("#VerForm").hide();// Mostramos el formulario
        $("#btnNuevo").show();// ocultamos el boton nuevo
        $("#VerListado").show();// ocultamos el listado
    }

}

function ListadoCategorias() {
    var tabla = $('#tblCategorias').dataTable(
            {   "pageLength": 5, 
                "aProcessing": true,
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
                    {"mDataProp": "2"}

                ], "ajax":
                        {
                            url: './ajax/CategoriaAjax.php?op=list',
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


function eliminarCategoria(id) {// funcion que llamamos del archivo ajax/CategoriaAjax.php?op=delete linea 53
    bootbox.confirm("¿Esta Seguro de eliminar la Categoria?", function (result) { // confirmamos con una pregunta si queremos eliminar
        if (result) {// si el result es true
            $.post("./ajax/CategoriaAjax.php?op=delete", {id: id}, function (e) {// llamamos la url de eliminar por post. y mandamos por parametro el id 


                swal("Mensaje del Sistema", e, "success");

                ListadoCategorias();
            });
        }

    })
}

function cargarDataCategoria(id, nombre) {// funcion que llamamos del archivo ajax/CategoriaAjax.php linea 52
    $("#VerForm").show();// mostramos el formulario
    $("#btnNuevo").hide();// ocultamos el boton nuevo
    $("#VerListado").hide();

    $("#txtIdCategoria").val(id);// recibimos la variable id a la caja de texto txtIdCategoria
    $("#txtNombre").val(nombre);// recibimos la variable nombre a la caja de texto txtNombre
}