var table_equipos

table_equipos = $("#equipos").DataTable({
    "ordering": true,
    "pageLength": 10,
    "bLengthChange": false,
    "responsive": true,
    "autoWidth": false,
    language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 de 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
    dom: 'Blrftip',
    buttons: [


        {
            extend: 'excelHtml5',
            text: '<i class="far fa-file-excel"> Excel</i>',
            titleAttr: 'Exportar a excel',
            className: 'btn excel',
            "excelStyles": [
                {
                    "cells": ":",
                    "width": 15,
                    "style": {
                        "alignment": {
                            "vertical": "center",
                            "horizontal": "center"
                        }
                    }
                },
                {
                    "cells": "A",
                    "width": 5,
                    "style": {
                        "alignment": {
                            "horizontal": "center"
                        }
                    }
                },
                {
                    "template": "blue_medium",
                },



            ],
            exportOptions: {
                columns: "thead th:not(.boto)"
            },

            pageStyle: {
                sheetPr: {
                    pageSetUpPr: {
                        filToPage: 1
                    }
                },
                printOptions: {
                    horizontalCentered: true

                },
                pageSetup: {
                    orientation: 'landscape',
                    paperSize: 9
                }
            },



        },
        {
            extend: 'pdfHtml5',
            text: '<i class="far fa-file-pdf"> PDF</i>',
            titleAttr: 'Exportar a PDF',
            className: 'btn pdf',
            messageTop: 'Lista',
            exportOptions: {
                columns: "thead th:not(.boto)"
            },



        },
        {
            extend: 'print',
            text: '<i class="fas fa-print"> Print</i>',
            titleAttr: 'Imprimir',
            messageTop: 'Lista',
            className: 'btn print mr-1 ',

            exportOptions: {
                columns: "thead th:not(.boto)"
            },

        },
    ],

    select: true,
});

document.getElementById('equipos_filter').style.display = "none";
$('input.global_filter').on('keyup click', function () {
    filterGlobal();
});
$('input.column_filter').on('keyup click', function () {
    filterColumn($(this).parents('tr').attr('data-column'));
});


function filterGlobal() {
    $('#equipos').DataTable().search(
        $('#global_filter').val(),
    ).draw()
}
function enviar_imagen(e) {
    console.log(e.target.src)
    mostrar_imagen(e.target.src)
}

function mostrar_imagen(imagen) {
    Swal.fire({
        imageUrl: `${imagen}`,
        imageAlt: 'A tall image',
        imageWidth: 400,
        imageHeight: 280,
        width: 400,
        padding:0,
        margin:0,
        confirmButtonText: 'Cerrar'
    })
}

