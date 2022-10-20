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

var tbl_tramite;
function listar_tramite() {
    var fechainicio = $('#fecha_inicio').val()
    var fechafin = $('#fecha_fin').val()
    let idusuario = document.getElementById('txtprincipalid').value;
    tbl_tramite = $("#tabla_tramite").DataTable({
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
            "url": "../controller/tramite_areaC.php?tipo=listar",
            type: 'POST',
            data: {
                idusuario: idusuario,
                fechainicio: fechainicio,
                fechafin: fechafin
            }
        },
        "columns": [
            { "data": "documento_id" },
            { "data": "tipodo_descripcion" },
            { "data": "REMITENTE" },
            { "data": "origen" },
            { "data": "destino" },
            { "defaultContent": `<button class='mas btn btn-primary btn-sm'><i class="fas fa-calendar-plus"></i></button>` },
            { "defaultContent": "<button class='seguimiento btn btn-success btn-sm'><i class='fa fa-search'></i></button>" },

            {
                "data": "doc_estatus",
                render: function (data, type, row) {
                    if (data == 'PENDIENTE') {
                        return '<span class="badge bg-warning">PENDIENTE</span>';
                    } else if (data == 'RECHAZADO') {
                        return '<span class="badge bg-danger">RECHAZADO</span>';
                    } else {
                        return '<span class="badge bg-success">FINALIZADO</span>';
                    }
                }
            },
            {
                "data": "doc_estatus",
                render: function (data, type, row) {
                    if (data == 'PENDIENTE') {
                        return "<button class='derivar btn btn-primary'><i class='fa fa-share-square'></i></button>";
                    } else {
                        return "<button class='btn btn-primary' disabled><i class='fa fa-share-square'></i></button>";
                    }
                }
            },

        ],


        select: true
    });
    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
}

$('#tabla_tramite').on('click', '.derivar', function () {
    var data = tbl_tramite.row($(this).parents('tr')).data();//En tamaño escritorio
    if (tbl_tramite.row(this).child.isShown()) {
        var data = tbl_tramite.row(this).data();
    }//Permite llevar los datos cuando es tamaño celular y usas el responsive de datatable
    $("#modal_derivar").modal('show');
    document.getElementById('lbl_titulo_derivar').innerHTML = "<b>DERIVAR O FINALIZAR TRAMITE</b> " + data.documento_id;
    document.getElementById('txt_fecha_de').value = data.doc_fecharegistro;
    document.getElementById('txt_origen_de').value = data.destino;
    Cargar_Select_Area_Destino(data.area_destino);
    document.getElementById('txt_idocumento_de').value = data.documento_id;
    document.getElementById('txt_idareorigen').value = data.area_destino;
})

$('#tabla_tramite').on('click', '.seguimiento', function () {
    var data = tbl_tramite.row($(this).parents('tr')).data();//En tamaño escritorio
    if (tbl_tramite.row(this).child.isShown()) {
        var data = tbl_tramite.row(this).data();
    }//Permite llevar los datos cuando es tamaño celular y usas el responsive de datatable
    $("#modal_seguimiento").modal('show');
    document.getElementById('lbl_titulo').innerHTML = "SEGUIMIENTO DEL TRAMITE " + data.documento_id;
    listar_seguimiento_tramite(data.documento_id);

})

$('#tabla_tramite').on('click', '.mas', function () {
    var data = tbl_tramite.row($(this).parents('tr')).data();//En tamaño escritorio
    if (tbl_tramite.row(this).child.isShown()) {
        var data = tbl_tramite.row(this).data();
    }//Permite llevar los datos cuando es tamaño celular y usas el responsive de datatable
    $("#modal_mas").modal('show');
    document.getElementById('lbl_titulo_datos').innerHTML = 'DATOS DEL TRAMITE ' + data.documento_id;
    document.getElementById('txt_ndocumento').value = data.doc_nrodocumento;
    document.getElementById('txt_folio').value = data.doc_folio;
    document.getElementById('txt_asunto').value = data.doc_asunto;
    $("#select_area_p").select2().val(data.area_origen).trigger('change.select2');
    $("#select_area_d").select2().val(data.area_destino).trigger('change.select2');
    $("#select_tipo").select2().val(data.tipodocumento_id).trigger('change.select2');

    document.getElementById('txt_dni').value = data.doc_dniremitente;
    document.getElementById('txt_nom').value = data.doc_nombreremitente;
    document.getElementById('txt_apepat').value = data.doc_apepatremitente;
    document.getElementById('txt_apemat').value = data.doc_apematremitente;
    document.getElementById('txt_celular').value = data.doc_celularremitente;
    document.getElementById('txt_email').value = data.doc_emailremitente;
    document.getElementById('txt_dire').value = data.doc_direccionremitente;
    if (data.doc_representacion == "A Nombre Propio") {
        $("#rad_presentacion1").prop('checked', true);
    }

    if (data.doc_representacion == "A Otra Persona Natural") {
        $("#rad_presentacion2").prop('checked', true);
    }

    if (data.doc_representacion == "Persona Jurídica") {
        $("#rad_presentacion3").prop('checked', true);
    }


})



function AbrirRegistro() {
    $("#modal_registro").modal({ backdrop: 'static', keyboard: false })
    $("#modal_registro").modal('show');
}


function Registrar_Derivacion() {
    //DATOS DEL REMITENTE
    let iddo = document.getElementById('txt_idocumento_de').value;
    let orig = document.getElementById('txt_idareorigen').value;
    let dest = document.getElementById('select_destino_de').value;
    let desc = document.getElementById('txt_descripcion_de').value;
    let arc = document.getElementById('txt_documento_de').value;
    let idusu = document.getElementById('txtprincipalid').value;
    let tipo = document.getElementById('select_derivar_de').value;
    let nombrearchivo = "";
    if (dest.length = 0) {
        Swal.fire("Mensaje de Advertencia", "Seleccionar el area destino", "warning");
    }
    if (arc == "") {

    } else {
        let f = new Date();
        let extension = arc.split('.').pop();//DOCUMENTO.PPT
        nombrearchivo = "ARCH" + f.getDate() + "" + (f.getMonth() + 1) + "" + f.getFullYear() + "" + f.getHours() + "" + f.getMilliseconds() + "." + extension;
    }
    let formData = new FormData();
    let archivoobj = $("#txt_documento_de")[0].files[0];//El objeto del archivo adjuntado
    //////DATOS DEL REMITENTE
    formData.append("iddo", iddo);
    formData.append("orig", orig);
    formData.append("dest", dest);
    formData.append("desc", desc);
    formData.append("idusu", idusu);
    formData.append("nombrearchivo", nombrearchivo);
    formData.append("archivoobj", archivoobj);
    formData.append("tipo", tipo);
    $.ajax({
        url: "../controller/tramite_areaC.php?tipo=registro",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (resp) {
            if (resp.length > 0) {
                Swal.fire("Mensaje de Confirmacion", "Tramite Derivado o Finalizado", "success").then((value) => {
                    $("#modal_derivar").modal('hide');
                    tbl_tramite.ajax.reload();
                });
            } else {
                Swal.fire("Mensaje de Advertencia", "No se pudo completar el procedo", "warning");
            }
        }
    });
    return false;
}


function Cargar_Select_Area() {
    $.ajax({
        "url": "../controller/usuarioC.php?tipo=cargar_select_area",
        type: 'POST'
    }).done(function (resp) {
        let data = JSON.parse(resp);
        if (data.length > 0) {
            let cadena = "<option value=''>SELECCIONAR AREA</option>";
            for (let i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }
            document.getElementById('select_area_p').innerHTML = cadena;
            document.getElementById('select_area_d').innerHTML = cadena;

        } else {
            cadena += "<option value=''>No hay areas disponibles</option>";
            document.getElementById('select_area_p').innerHTML = cadena;
            document.getElementById('select_area_d').innerHTML = cadena;
        }
    })
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
            document.getElementById('select_tipo').innerHTML = cadena;

        } else {
            cadena += "<option value=''>No hay tipos disponibles</option>";
            document.getElementById('select_tipo').innerHTML = cadena;
        }
    })
}

function Cargar_Select_Area_Destino(id) {
    $.ajax({
        "url": "../controller/usuarioC.php?tipo=cargar_select_area",
        type: 'POST',
    }).done(function (resp) {
        let data = JSON.parse(resp);
        if (data.length > 0) {
            let cadena = "<option value=''>SELECCIONAR AREA</option>";
            for (let i = 0; i < data.length; i++) {
                if (data[i][0] != id) {
                    cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
                }
            }
            document.getElementById('select_destino_de').innerHTML = cadena;
        } else {
            cadena += "<option value=''>No hay areas disponibles</option>";
            document.getElementById('select_destino_de').innerHTML = cadena;
        }
    })
}

function Registrar_Tramite() {
    //DATOS DOCUMENTO 

    let arp = document.getElementById('select_area_p').value;
    let ard = document.getElementById('select_area_d').value;
    let tip = document.getElementById('select_tipo').value;
    let ndo = document.getElementById('txt_ndocumento').value;
    let asu = document.getElementById('txt_asunto').value;
    let arc = document.getElementById('txt_archivo').value;
    let fol = document.getElementById('txt_folio').value;

    console.log(asu)

    //DATOS DEL REMITENTE
    let dni = document.getElementById('txt_dni').value;
    let nom = document.getElementById('txt_nom').value;
    let apt = document.getElementById('txt_apepat').value;
    let apm = document.getElementById('txt_apemat').value;
    let cel = document.getElementById('txt_celular').value;
    let ema = document.getElementById('txt_email').value;

    let idusu = document.getElementById('txtprincipalid').value;

    if (arc.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Seleccine algun tipo de documento", "warning");
    }

    let extension = arc.split('.').pop();//DOCUMENTO.PPT
    let nombrearchivo = "";
    let f = new Date();
    if (arc.length > 0) {
        nombrearchivo = "ARCH" + f.getDate() + "" + (f.getMonth() + 1) + "" + f.getFullYear() + "" + f.getHours() + "" + f.getMilliseconds() + "." + extension;
    }
    if (dni.length == 0 || nom.length == 0 || apt.length == 0 || apm.length == 0 || cel.length == 0 || ema.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Llene todos los datos del remitente", "warning");
    }

    if (arp.length == 0 || tip.length == 0 || ndo.length == 0 || asu.length == 0 || ard.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Llene todos los datos del documento", "warning");
    }

    let formData = new FormData();
    let archivoobj = $("#txt_archivo")[0].files[0];//El objeto del archivo adjuntado
    //////DATOS DEL REMITENTE
    formData.append("dni", dni);
    formData.append("nom", nom);
    formData.append("apt", apt);
    formData.append("apm", apm);
    formData.append("cel", cel);
    formData.append("ema", ema);



    //////DATOS DEL DOCUMENTO
    formData.append("arp", arp);
    formData.append("ard", ard);
    formData.append("tip", tip);
    formData.append("ndo", ndo);
    formData.append("asu", asu);
    formData.append("nombrearchivo", nombrearchivo);
    formData.append("fol", fol);
    formData.append("archivoobj", archivoobj);
    formData.append("idusu", idusu);
    $.ajax({
        url: "../controller/tramiteC.php?tipo=registro",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (resp) {
            if (resp.length > 0) {
                Swal.fire("Mensaje de Confirmacion", "Nuevo tramite registrado codigo " + resp, "success").then((value) => {
                    window.open("MPDF/REPORTE/ticket_tramite.php?codigo=" + resp + "#zoom=100");
                    $("#contenido_principal").load("tramite/view_tramite.php");
                });
            } else {
                Swal.fire("Mensaje de Advertencia", "El Usuairo ingresado ya se encuentra en la base de datos", "warning");
            }
        }
    });
    return false;
}


///SEGUIMIENTO TRAMITE
var tbl_seguimiento;
function listar_seguimiento_tramite(id) {
    tbl_seguimiento = $("#tabla_seguimiento").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/tramiteC.php?tipo=listar_seguimiento",
            type: 'POST',
            data: {
                id: id
            }
        },
        "columns": [
            { "data": "area_nombre" },
            { "data": "mov_fecharegistro" },
            { "data": "mov_descripcion" },
            {
                "data": "mov_archivo",
                render: function (data, type, row) {
                    if (data == '') {
                        return "<button class='btn btn-danger btn-sm'><i class='fa fa-file-pdf' disabled></i></button>";
                    } else {
                        return "<button class='ver btn btn-danger btn-sm'><i class='fa fa-file-pdf'></i></button>";
                    }
                }

            },

        ],

        "language": idioma_espanol,
        select: true
    });
}

$('#tabla_seguimiento').on('click', '.ver', function () {
    var data = tbl_seguimiento.row($(this).parents('tr')).data();//En tamaño escritorio
    if (tbl_seguimiento.row(this).child.isShown()) {
        var data = tbl_seguimiento.row(this).data();
    }//Permite llevar los datos cuando es tamaño celular y usas el responsive de datatable
    window.open('../' + data.mov_archivo);

})
var tbl_tramite_enviado;
function listar_tramites_enviados() {
    var fechainicio = $('#fecha_inicio').val()
    var fechafin = $('#fecha_fin').val()
    let idarea = document.getElementById('txtprincipalarea').value;
    tbl_tramite_enviado = $("#tabla_tramite_enviado").DataTable({
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
            "url": "../controller/tramite_areaC.php?tipo=listar_enviados",
            type: 'POST',
            data: {
                idarea,
                fechainicio: fechainicio,
                fechafin: fechafin
            }
        },
        "columns": [
            { "data": "documento_id" },
            { "data": "tipodo_descripcion" },
            { "data": "REMITENTE" },
            { "data": "origen" },
            { "data": "destino" },
            { "defaultContent": `<button class='mas btn btn-primary btn-sm'><i class="fas fa-calendar-plus"></i></button>` },
            { "defaultContent": "<button class='seguimiento btn btn-success btn-sm'><i class='fa fa-search'></i></button>" },

            {
                "data": "doc_estatus",
                render: function (data, type, row) {
                    if (data == 'PENDIENTE') {
                        return '<span class="badge bg-warning">PENDIENTE</span>';
                    } else if (data == 'RECHAZADO') {
                        return '<span class="badge bg-danger">RECHAZADO</span>';
                    } else {
                        return '<span class="badge bg-success">FINALIZADO</span>';
                    }
                }
            },


        ],


        select: true
    });
    $('input.global_filter').on('keyup click', function () {
        filterGlobalEnviado();
    });
    $('input.column_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
}
function filterGlobalEnviado() {
    $('#tabla_tramite_enviado').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}
function filterGlobal() {
    $('#tabla_tramite').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}