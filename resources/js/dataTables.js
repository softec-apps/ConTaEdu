// import DataTable from 'datatables.net-bs5';
// import 'datatables.net-buttons-bs5';
// import 'datatables.net-buttons/js/buttons.html5.mjs';
// import 'datatables.net-buttons/js/buttons.print.mjs';
// import 'datatables.net-responsive-bs5';

// Modify the default style for buttons
DataTable.Buttons.defaults.dom.button.className = 'dt-button btn app-btn-secondary mx-1 mb-1';


function setDataTableConfig(options = {}, customButtons = []) {
    const finalConfig = {
        columnDefs: [
            { targets: 'exclude-view', visible: false }
        ],
        language: {
            // loadingRecords: `<div class="loader-container">
            //     <div class="loader"></div>
            //     <div class="loader-text">Cargando...</div>
            // </div>`,
            url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/es-MX.json',
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
        autoWidth: true,
        searching: true,
        // dom: `<"row my-3"<"col-sm-4 col-lg-3"l><"col-sm-8 col-lg-4"f><"col-sm-12 col-lg-5"B>>rtp`,
        dom: '<"row my-3"<"col-sm-4 col-lg-3"l><"col-sm-8 col-lg-9 d-flex align-items-start"f><"col-sm-12 col-lg-12 d-flex justify-content-start"B>>rt<"row my-2"<"col-sm-6"i><"col-sm-6 d-flex justify-content-end"p>>',
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
                // className: 'mx-3',
                buttons: [
                    {
                        extend: 'pdf',
                        text: '<i class="fa-solid fa-file-pdf"></i> PDF',
                        // className: 'd-flex',
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
                ],
            },
            // {
            //     text: '<i class="fa-solid fa-circle-plus"></i> Agregar',
            //     className: 'ms-3 btn bg-success text-white'
            // },
        ],
        initComplete: function (settings, json) {
            // Mostrar la tabla después de que DataTables se haya inicializado
            $(this).removeClass('d-none');
            // Eliminar loader
            $('.loader-container').remove();
            // Agregar la clase personalizada de pagination
            $('.dt-paging').addClass('app-pagination mt-2');
        },
    };

    if (options) {
        Object.assign(finalConfig, options);
    }

    if (customButtons) {
        Object.keys(customButtons).forEach(key => {
            finalConfig.buttons.push(customButtons[key]);
        });
    }

    return finalConfig;
}


// >>> Tabla de ejemplo
// >>> Definir la tabla en la sección scripts de la plantilla
// >>> Configurar de esta manera las tablas llamando a la función definida.
// >>> Escribir las opciones extra de consulta (ajax) etc
// >>> Segundo parámetro, botones personalizados

// $('#usersTable').DataTable(setDataTableConfig(
//     {
//         processing: true,
//         ajax: {
//             url: "http://localhost/SoftecApps/ConTaEdu/public/docente/students",
//             // SI NO FUNCIONA NORMALMENTE AGREGAR ESTE CONTENIDO
//             // dataSrc: function(json) {
//             //     return json.data; // Ensure this matches the structure you return from the server
//             // },
//             // dataFilter: function(data){
//             //     var json = JSON.parse( data );
//             //     return JSON.stringify( json ); // return JSON string
//             // },
//             // error: function(xhr, error, thrown) {
//             //     console.error("AJAX error:", error);
//             // }
//         },
//         columns: [
//             { data: 'ci' },
//             { data: 'name' },
//             { data: 'email' },
//             { data: 'created_at' },
//         ],
//     },
//     [
//         {
//             text: '<i class="fa-solid fa-circle-plus"></i> Agregar',
//             className: 'btn bg-success text-white',
//             action: function () {
//                 $('#modalName').modal('show');
//             }
//         },
//     ],
// ));

window.setDataTableConfig = setDataTableConfig;