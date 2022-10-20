var  tbl_resumen;
function listar_area(){
    tbl_resumen = $("#tabla_resumen").DataTable({
        "ordering":true,   
        "bLengthChange":true,
        "searching": { "regex": false },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "destroy":true,
        "processing": true,
        "responsive": true,
        "autoWidth": false,
          select: true,
        "ajax":{
            "url":"../controller/resumenC.php?tipo=listar",
            type:'POST'
        },
        "columns":[
            {"defaultContent":""},
            {"data":"año"},
            {"data":"mes"},
            {"data":"archivo"},
            {"defaultContent":`<button class='descargar btn btn-primary'><i class="fas fa-download"></i> descargar</button>`},
           
        ],
    });
    tbl_resumen.on('draw.td',function(){
      var PageInfo = $("#tabla_resumen").DataTable().page.info();
      tbl_resumen.column(0, {page: 'current'}).nodes().each(function(cell, i){
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    });

    document.querySelector('#tabla_resumen_filter').style.display = "none";
    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

}

function filterGlobal() {
    $('#tabla_resumen').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}


function abrir_modal() {
    $("#registrar_resumen").modal({
        backdrop: 'static',
        keyboard: false
    })
    $("#registrar_resumen").modal('show');
}

function cleanForm() {
    $("#year").val("");
    $("#month").val("");
    $("#fileplh").val("");
}

function generateResume() {

    let year = $("#year").val();
    let month = $("#month").val();
    let fileplh = $("#fileplh")[0].files[0];

    if (year.length < 4 || month.length < 1) {
        return Swal.fire({
            icon: "error",
            title: "Error...",
            text: "El año y el mes deben tener un formato correcto!",
            timer: 2700,
        });
    }

    if (!fileplh) {
        return Swal.fire({
            icon: "error",
            title: "Error...",
            text: "El archivo DATOSPLH es requerido!",
            timer: 2700,
        });
    }

    const formData = new FormData();
    formData.append("year", year);
    formData.append("month", month);
    formData.append("fileplh", fileplh);

    Swal.fire({
        title: "<strong>Generando...</strong>",
        showConfirmButton: false
    });

    $.ajax({
        url: "resumen/insertar.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        error: function() {
            Swal.fire({
                icon: "error",
                title: "Error...",
                text: "Ocurrió un error en el servidor.",
                timer: 2700,
            });
        },
    }).done((response) => {
        console.log(response)
        const resp = JSON.parse(response);

        if (typeof resp.mes === "string") {
            cleanForm();
            const {
                mes,
                anio
            } = resp;
            $.ajax({
                url: "resumen/crear.php",
                type: "POST",
                data: {
                    mes,
                    anio
                },
                error: function() {
                    Swal.fire({
                        icon: "error",
                        title: "Error...",
                        text: "Ocurrió un error en el servidor.",
                        timer: 2700,
                    });
                },
            }).done((response) => {
                Swal.fire({
                    icon: "success",
                    title: "Creado!",
                    text: "El resumen fue creado correctamente!",
                    timer: 2700,
                });
                let ruta = 'resumen/db/' + response
                location.href = ruta;
            });
        } else {
            const {
                errors
            } = resp;
            let msg = "";
            for (const error in errors) {
                msg += errors[error] + " ";
            }
            Swal.fire({
                icon: "error",
                title: "Llenar correctamente!",
                text: msg,
                timer: 2700,
            });
        }
    });
}