import $ from 'jquery';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.html5.mjs';
import 'datatables.net-buttons/js/buttons.print.mjs';
import 'datatables.net-responsive-bs5';

// Modify the default style for buttons
DataTable.Buttons.defaults.dom.button.className = 'btn app-btn-secondary';


function setDataTableConfig(customButtons = []) {
    return {
        columnDefs: [
            { targets: 'exclude-view', visible: false }
        ],
        initComplete: function() {
            // Mostrar la tabla después de que DataTables se haya inicializado
            $(this).removeClass('d-none');
            // Eliminar loader
            $('.loader-container').remove();
            // Agregar la clase personalizada de pagination
            $('.dt-paging').addClass('app-pagination mt-2');
            // Redimensionar las columnas para que sean responsive
            var table = $(this).DataTable();
            table.responsive.recalc();
        },
        language: {
            lengthMenu: "<div class=\"d-flex align-items-center\"><select class=\"form-select\">" +
                "<option value=\"10\">10</option>" +
                "<option value=\"20\">20</option>" +
                "<option value=\"30\">30</option>" +
                "<option value=\"-1\">Todo</option>" +
            "</select><div class=\"ms-2\">resultados</div></div>",
            zeroRecords: "No hay coincidencias",
            emptyTable: "No existen registros",
            paginate: {
                previous: "Anterior",
                next: "Siguiente",
            },
            search: '',
            searchPlaceholder: 'Buscar',
        },
        pagingType: 'simple_numbers',
        responsive: true,
        dom: `<"row"<"col-sm-4 col-lg-2"l><"col-sm-8 col-lg-5"f><"col-sm-12 col-lg-5"B>>rtp`,
        buttons: [
            {
                extend: 'copy',
                text: '<i class="fa-regular fa-copy"></i> Copiar',
                exportOptions: {
                    columns: ":not(.exclude)",
                },
            },
            {
                extend: 'print',
                text: '<i class="fa-solid fa-print"></i> Imprimir',
                exportOptions: {
                    columns: ":not(.exclude)",
                },
            },
            {
                extend: 'collection',
                text: 'Exportar',
                className: 'mx-3',
                buttons: [
                    {
                        extend: 'pdf',
                        text: '<i class="fa-solid fa-file-pdf"></i> PDF',
                        exportOptions: {
                            columns: ":not(.exclude)",
                        },
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fa-solid fa-file-csv"></i> CSV',
                        exportOptions: {
                            columns: ":not(.exclude)",
                        },
                    },
                ]
            },
            customButtons
            // {
            //     text: '<i class="fa-solid fa-circle-plus"></i> Agregar',
            //     className: 'ms-3 btn bg-success text-white'
            // },
        ]
    };
}


$('#myTable').DataTable(setDataTableConfig(
    [
        {
            text: '<i class="fa-solid fa-circle-plus"></i> Agregar',
            className: 'btn bg-success text-white',
            // Aquí link de redirection y funciones
        },
    ]
));
