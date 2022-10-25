function fechadefault() {
    n = new Date();
    y = n.getFullYear();
    m = n.getMonth() + 1;
    d = n.getDate();
    if (d < 10) { d = '0' + d }
    if (m < 10) { m = '0' + m }
    document.getElementById("fecha_inicio").value = y + "-" + m + "-" + d;
    document.getElementById("fecha_fin").value = y + "-" + m + "-" + d;
}
function Cargar_Select_Tipo() {
    $.ajax({
        "url": "../controller/tramiteC.php?tipo=cargar_select_tip",
        type: 'POST'
    }).done(function (resp) {
        let data = JSON.parse(resp);
        if (data.length > 0) {
            let cadena = "<option value=''>SELECCIONAR TIPO DOCUMENTO</option>";
            for (let i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }
            document.getElementById('tdoc').innerHTML = cadena;

        } else {
            cadena += "<option value=''>No hay tipos disponibles</option>";
            document.getElementById('tdoc').innerHTML = cadena;
        }
    })
}

var tbl_scan;
function listar_scan() {
    var fechainicio = $('#fecha_inicio').val()
    var fechafin = $('#fecha_fin').val()
    let idarea=$('#txtprincipalarea').val()
    tbl_scan = $("#tabla_scan").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "processing": true,
        "responsive": true,
        "autoWidth": false,
        select: true,
        "ajax": {
            "url": "../controller/scanC.php?tipo=listar",
            type: 'POST',
            data: {
                fechainicio: fechainicio,
                fechafin: fechafin,
                idarea:idarea
            }
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "nro_doc" },
            { "data": "tipodo_descripcion" },
            { "data": "asunto_doc" },
            { "data": "fechare_doc" },
            { "defaultContent": `<button  type='button' class='editar btn btn-primary'><i class='fa fa-edit'></i> Editar</button>
                                 <button class='descargar btn btn-primary' download><i class="fas fa-download"></i> Descargar</button>`}

        ],
        select: true
    });
    tbl_scan.on('draw.dt', function () {
        var PageInfo = $('#tabla_scan').DataTable().page.info();
        tbl_scan.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
}
function filterGlobal() {
    $('#tabla_scan').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}

function abrir_modal() {
    $("#modal_registro").modal({ backdrop: 'static', keyboard: false })
    $("#modal_registro").modal('show');
}

function registrar_scan() {
    let ndoc = document.querySelector('#ndoc').value;
    let tdoc = document.querySelector('#tdoc').value;
    let asunto = document.querySelector('#asunto_scan').value;
    let archivo = document.querySelector('#archivo_scan').value;
    let abrev = document.querySelector('#txtprincipalarea').value;
    let idusu = document.querySelector('#txtprincipalid').value;
    if (ndoc.length == 0 || tdoc.length == 0 || asunto.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Complete los campos vacios");
    }
    if (archivo.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Seleccine algun tipo de documento", "warning");
    }

    let extension = archivo.split('.').pop();//DOCUMENTO.PPT
    let nombrearchivo = "";
    let f = new Date();
    if (archivo.length > 0) {
        nombrearchivo = "A" + abrev + "S" + f.getDate() + "" + (f.getMonth() + 1) + "" + f.getFullYear() + "" + f.getHours() + "" + f.getMilliseconds() + "." + extension;
    }

    let formData = new FormData();
    let archivoobj = $("#archivo_scan")[0].files[0];//El objeto del archivo adjuntado
    formData.append("ndoc", ndoc);
    formData.append("tdoc", tdoc);
    formData.append("asun", asunto);
    formData.append("nombrearchivo", nombrearchivo);
    formData.append("archivoobj", archivoobj);
    formData.append("idusu", idusu);
    formData.append("idarea", abrev);

    $.ajax({
        url: "../controller/scanC.php?tipo=registro",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (resp) {
            if (resp > 0) {
                if (resp == 1) {
                    Swal.fire("Mensaje de Confirmacion", "Documento guardado correctamente", "success");
                } else {
                    return Swal.fire("Mensaje de Advertencia", "El documento ya existe en la base de datos ", "warning");
                }
            } else {
                return Swal.fire("Mensaje de Error", "No se pudo guardar el documento", "error");
            }
        }

    })
}

$('#tabla_scan').on('click','.editar',function(){
	var data = tbl_scan.row($(this).parents('tr')).data();//En tamaño escritorio
	if(tbl_scan.row(this).child.isShown()){
		var data = tbl_scan.row(this).data();
	}//Permite llevar los datos cuando es tamaño celular y usas el responsive de datatable
    $("#modal_editar").modal('show');
    document.getElementById('txt_idusuario').value=data.usu_id;
    $("#select_empleado_editar").select2().val(data.empleado_id).trigger('change.select2');
    $("#select_area_editar").select2().val(data.area_id).trigger('change.select2');
    $("#select_rol_editar").select2().val(data.usu_rol).trigger('change.select2');
})
$('#tabla_scan').on('click', '.descargar', function () {
    let data = tbl_scan.row($(this).parents('tr')).data();
    if (tbl_scan.row(this).child.isShown()) {
        data = tbl_scan.row(this).data();
    }

    window.open(`../${data.ruta}`);
     
     

    


})