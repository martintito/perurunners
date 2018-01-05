// JavaScript Document
  $( function(){
    $( "#fecha_nac" ).datepicker({
			maxDate: "-5y",
			dateFormat: "yy-mm-dd"
		});
  });

$(document).ready(function () {
	$( "#form1" ).validate({
	  rules: {
		email: {
		  required: true,
		  email: true
		},
		nombre: {
		  required: true
		},
		fecha_nac: {
		  required: true,
			dateISO: true
		},
		n_doc: {
		  required: true,
		  minlength: 7
		},
		tipo_doc: {
		  required: true
		},
		telef_fijo: {
		  required: true,
		  digits: true
		},
		celular: {
		  required: true,
		  digits: true
		}
	  },
	  messages:{
	  	email: {
		  	required: "Ingrese su correo electrónico",
		  	email: " Ingrese su correo correctamente"
			},
			fecha_nac:{
				required: "Ingrese la fecha (aaaa-mm-dd)",
				dateISO: "La fecha debe tener el formato (aaaa-mm-dd)"
			},
			nombre:{
				required: "Ingrese su nombre"
			},
			paterno:{
				required: "Ingrese su apellido paterno"
			},
			materno:{
				required: "Ingrese su apellido materno"
			},
			num_doc:{
				required: "Ingrese su número de documento",
				minlength: "El número debe tener como mínimo 8 dígitos"
			},
			tipo_doc:{
				required: "Se debe escoger un tipo de documento"
			},
			tele_fijo:{
				required: "Ingrese su número de teléfono fijo",
				minlength: "El número debe tener como mínimo 7 dígitos",
				digits: "El campo solo debe contener números"
			},
			celular:{
				required: "Ingrese su número de celular",
				minlength: "El número debe tener como mínimo 9 dígitos",
				digits: "El campo solo debe contener números"
			},
	  }	  
	});
});