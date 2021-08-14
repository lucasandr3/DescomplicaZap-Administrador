/*DataTable Init*/

"use strict"; 

$(document).ready(function() {
	$('#datable_1').DataTable({
		responsive: true,
		autoWidth: false,
		language: {
			"sProcessing":     "Processando...",
			"sLengthMenu":     "_MENU_ Registros",
			"sZeroRecords":    "Não Foi Econtrado Registros",
			"sEmptyTable":     "Nenhum Dado Disponivel Na Tabela",
			"sInfo":           "Mostrando Registros de _START_ a _END_ De Um Total de _TOTAL_",
			"sInfoEmpty":      "Mostrando Registros de 0 a 0 De Um Total De 0",
			"sInfoFiltered":   "(Filtrado De Um total de _MAX_ Registros)",
			"sInfoPostFix":    "",
			"sSearch":         "",
			"searchPlaceholder": "Pesquisar",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Carregando...",
			"oPaginate": {
				"sFirst":    "Primeiro",
				"sLast":     "Último",
				"sNext":     "Próximo",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Ordenar De Maneira Ascendente",
				"sSortDescending": ": Ordenar De maneira Decresente"
			},
		},
	});

	$('#datable_pw').DataTable({
		responsive: true,
		autoWidth: false,
		language: {
			"sProcessing":     "Processando...",
			"sLengthMenu":     "_MENU_ Registros",
			"sZeroRecords":    "Não Foi Econtrado Registros",
			"sEmptyTable":     "Nenhum Dado Disponivel Na Tabela",
			"sInfo":           "Mostrando Registros de _START_ a _END_ De Um Total de _TOTAL_",
			"sInfoEmpty":      "Mostrando Registros de 0 a 0 De Um Total De 0",
			"sInfoFiltered":   "(Filtrado De Um total de _MAX_ Registros)",
			"sInfoPostFix":    "",
			"sSearch":         "",
			"searchPlaceholder": "Pesquisar",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Carregando...",
			"oPaginate": {
				"sFirst":    "Primeiro",
				"sLast":     "Último",
				"sNext":     "Próximo",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Ordenar De Maneira Ascendente",
				"sSortDescending": ": Ordenar De maneira Decresente"
			},
		},
	});

	$('#datable_pp').DataTable({
		responsive: true,
		autoWidth: false,
		language: {
			"sProcessing":     "Processando...",
			"sLengthMenu":     "_MENU_ Registros",
			"sZeroRecords":    "Não Foi Econtrado Registros",
			"sEmptyTable":     "Nenhum Dado Disponivel Na Tabela",
			"sInfo":           "Mostrando Registros de _START_ a _END_ De Um Total de _TOTAL_",
			"sInfoEmpty":      "Mostrando Registros de 0 a 0 De Um Total De 0",
			"sInfoFiltered":   "(Filtrado De Um total de _MAX_ Registros)",
			"sInfoPostFix":    "",
			"sSearch":         "",
			"searchPlaceholder": "Pesquisar",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Carregando...",
			"oPaginate": {
				"sFirst":    "Primeiro",
				"sLast":     "Último",
				"sNext":     "Próximo",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Ordenar De Maneira Ascendente",
				"sSortDescending": ": Ordenar De maneira Decresente"
			},
		},
	});

	$('#datable_pd').DataTable({
		responsive: true,
		autoWidth: false,
		language: {
			"sProcessing":     "Processando...",
			"sLengthMenu":     "_MENU_ Registros",
			"sZeroRecords":    "Não Foi Econtrado Registros",
			"sEmptyTable":     "Nenhum Dado Disponivel Na Tabela",
			"sInfo":           "Mostrando Registros de _START_ a _END_ De Um Total de _TOTAL_",
			"sInfoEmpty":      "Mostrando Registros de 0 a 0 De Um Total De 0",
			"sInfoFiltered":   "(Filtrado De Um total de _MAX_ Registros)",
			"sInfoPostFix":    "",
			"sSearch":         "",
			"searchPlaceholder": "Pesquisar",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Carregando...",
			"oPaginate": {
				"sFirst":    "Primeiro",
				"sLast":     "Último",
				"sNext":     "Próximo",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Ordenar De Maneira Ascendente",
				"sSortDescending": ": Ordenar De maneira Decresente"
			},
		},
	});

    $('#datable_2').DataTable({ 
		autoWidth: false,
		lengthChange: false,
		"bPaginate": false,
		language: { search: "",searchPlaceholder: "Search" }
	});
	
	/*Export DataTable*/
	$('#datable_3').DataTable( {
		dom: 'Bfrtip',
		responsive: true,
		language: { search: "",searchPlaceholder: "Search" },
		"bPaginate": false,
		"info":     false,
		"bFilter":     false,
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		],
		"drawCallback": function () {
			$('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
		}
	} );
	
	var table = $('#datable_5').DataTable({
		responsive: true,
		language: { 
		search: "" ,
		sLengthMenu: "_MENU_Items",
		},
		"bPaginate": false,
		"info":     false,
		"bFilter":     false,
		});
	$('#datable_5 tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
 
    $('#button').click( function () {
        table.row('.selected').remove().draw( false );
    } );
} );