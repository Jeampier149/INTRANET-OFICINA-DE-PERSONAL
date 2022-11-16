function fechadefault() {
    n = new Date();
    y = n.getFullYear();
    m = n.getMonth()- 1;
    d = n.getDate();
    mf=n.getMonth()+ 1;
    if (d < 10) { d = '0' + d}
    if (m < 10) { m = '0' + m }
    document.getElementById("fecha_inicio").value = y + "-" + m + "-" + d;
    document.getElementById("fecha_fin").value = y + "-" + mf + "-" + d;
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
            document.getElementById('tdoc_edit').innerHTML = cadena;

        } else {
            cadena += "<option value=''>No hay tipos disponibles</option>";
            document.getElementById('tdoc').innerHTML = cadena;
            document.getElementById('tdoc_edit').innerHTML = cadena;
        }
    })
}

var tbl_scan;
function listar_scan() {
    var fechainicio = $('#fecha_inicio').val()
    var fechafin = $('#fecha_fin').val()
    let idarea = $('#txtprincipalarea').val()
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
                idarea: idarea
            }
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "nro_doc" },
            { "data": "tipodo_descripcion" },
            { "data": "asunto_doc" },
            { "data": "fechare_doc" },
            {
                "defaultContent": `<button  type='button' class='editar btn editable'><i class='fa fa-edit'></i> Editar</button>
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
                    tbl_scan.ajax.reload();
                    $('#modal_registro').modal('hide')
                } else {
                    return Swal.fire("Mensaje de Advertencia", "El documento ya existe en la base de datos ", "warning");
                }
            } else {
                return Swal.fire("Mensaje de Error", "No se pudo guardar el documento", "error");
            }
        }

    })
}

$('#tabla_scan').on('click', '.editar', function () {
    var data = tbl_scan.row($(this).parents('tr')).data();//En tamaño escritorio
    if (tbl_scan.row(this).child.isShown()) {
        var data = tbl_scan.row(this).data();
    }//Permite llevar los datos cuando es tamaño celular y usas el responsive de datatable
    $("#modal_editar").modal('show');
    $("#ndoc_edit").val(data.nro_doc);
    $("#doc_src").val(data.ruta);
    $('#id_doc').val(data.id_doc)
    $("#ndoc_actual").val(data.nro_doc);
    $("#tdoc_edit").val(data.tipo_doc).trigger('change');
    $('#asunt .note-editable').html(data.asunto_doc)
})
$('#tabla_scan').on('click', '.descargar', function () {
    let data = tbl_scan.row($(this).parents('tr')).data();
    if (tbl_scan.row(this).child.isShown()) {
        data = tbl_scan.row(this).data();
    }

    window.open(`../${data.ruta}`);

})

function editar_scan() {
    let ndoc_e = document.querySelector('#ndoc_edit').value;
    let ndoc_actual = document.querySelector('#ndoc_actual').value;
    let tdoc_e = document.querySelector('#tdoc_edit').value;
    let asunto_e = document.querySelector('#asunto_scan_edit').value;
    let iddoc = document.querySelector('#id_doc').value;
    let formData = new FormData();
    formData.append("ndoc", ndoc_e);
    formData.append("ndoc_actual", ndoc_actual);
    formData.append("tdoc", tdoc_e);
    formData.append("asun", asunto_e);
    formData.append("iddoc", iddoc);
    $.ajax({
        url: "../controller/scanC.php?tipo=editar",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (resp) {
            if (resp > 0) {
                if (resp == 1) {
                    Swal.fire("Mensaje de Confirmacion", "Registro editado correctamente", "success");
                    tbl_scan.ajax.reload();
                    $('#modal_editar').modal('hide')
                } else {
                    return Swal.fire("Mensaje de Advertencia", "El documento ya existe en la base de datos ", "warning");
                }
            } else {
                return Swal.fire("Mensaje de Error", "No se pudo guardar el documento", "error");
            }
        }

    })
}

function actualizar_doc_scan() {
    let doc_src=document.querySelector('#doc_src').value;
    console.log(doc_src)
    let actual=doc_src.split('/')
    let name=actual[actual.length-1];
    console.log(name)
    let id_doc = document.querySelector('#id_doc').value;
    let abrev = document.querySelector('#txtprincipalarea').value;
    let archivo = document.querySelector('#archivo_scan_edit').value;
    let extension = archivo.split('.').pop();//DOCUMENTO.PPT
    let nombrearchivo = "";
    let f = new Date();
    if (archivo.length > 0) nombrearchivo = "A" + abrev + "S" + f.getDate() + "" + (f.getMonth() + 1) + "" + f.getFullYear() + "" + f.getHours() + "" + f.getMilliseconds() + "." + extension  
    if(archivo.length==0) return Swal.fire("Mensaje de Advertencia","Cargue el nuevo documento","warning")
    let formData = new FormData();
    let archivoobj = $("#archivo_scan_edit")[0].files[0];//El objeto del archivo adjuntado
    formData.append("id_doc",id_doc);
    formData.append("nombre_archivo",nombrearchivo);
    formData.append("archivoobj",archivoobj);
    formData.append("name",name)
    $.ajax({
        url: "../controller/scanC.php?tipo=editar_doc",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
    }).done(function (resp){

            if (resp == 1) {
                Swal.fire("Mensaje de Confirmacion", "Registro editado correctamente", "success");
                tbl_scan.ajax.reload();
                $('#modal_editar').modal('hide')
            } else {
                return Swal.fire("Ocurrio un Error", "No se pudo actualizar el documento", "error");
            }
       
    })
}