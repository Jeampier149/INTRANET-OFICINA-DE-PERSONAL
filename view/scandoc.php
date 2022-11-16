<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>DOCUMENTOS GUARDADOS</h4>
        </div>
        <div class="card-body">
            <div class="contenido mb-4">
                <div class="row d-flex  align-items-center justify-content-around">
                    <div class="col-lg-5">
                        <label for="">Fecha Inicio</label>
                        <input type="date" name="fechai" id="fecha_inicio" class="form-control">
                    </div>
                    <div class="col-lg-5">
                        <label for="">Fecha Fin</label>
                        <input type="date" name="fechaf" id="fecha_fin" class="form-control">
                    </div>
                    <div class="col-lg-2">
                        &nbsp;
                        <button class="btn btn-primary" style="width:100%" onclick="listar_scan()"><i class="glyphicon glyphicon-search"> </i> Buscar</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-lg-10">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control global_filter" id="global_filter">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-primary" style="width: 100%;" onclick="abrir_modal()">Nuevo</button>
                    </div>
                </div>
                <table id="tabla_scan" class="display responsive  table" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nro Doc</th>
                            <th>Tipo Doc</th>
                            <th>Asunto</th>
                            <th>fecha de registro</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script src="../js/console_scan.js"></script>
<div class="modal fade" id="modal_registro" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>GUARDAR DOCUMENTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 form-group">
                                <label for="ndoc">N° Documento</label>
                                <input type="text" class="form-control" id="ndoc">
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label for="" style="font-size:small;">TIPO DOCUMENTO</label>
                                <select class="js-example-basic-single" id="tdoc" style="width:100%">
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="" style="font-size:small;">ASUNTO DEL DOCUMENTO</label>
                                <textarea name="" class="summernote-simple" id="asunto_scan" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8 form-group">
                                <label for="" style="font-size:small;">Adjuntar documento</label>
                                <input type="file" class="form-control" id="archivo_scan">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="registrar_scan()">Guardar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_editar" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>EDITAR DOCUMENTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <input type="text" class="form-control" id="id_doc" hidden>
                            <div class="col-12 col-md-6 form-group">
                                <label for="ndoc">N° Documento</label>
                                <input type="text" class="form-control" id="ndoc_edit">
                                <input type="text" class="form-control" id="ndoc_actual">

                            </div>
                            <div class="col-12 col-md-6 form-group ">
                                <label for="" style="font-size:small;">TIPO DOCUMENTO</label>
                                <select class="js-example-basic-single" id="tdoc_edit" style="width:100%">
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" id="asunt">
                                <label for="" style="font-size:small;">ASUNTO DEL DOCUMENTO</label>
                                <textarea name="" class="summernote-simple" id="asunto_scan_edit" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center">
                            <div class="col-8 form-group">
                                <label for="" style="font-size:small;">Adjuntar documento</label>
                                <input type="file" class="form-control" id="archivo_scan_edit">
                                <input type="text" id="doc_src">
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-success" onclick="actualizar_doc_scan()">Actualizar documento</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="editar_scan()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
    fechadefault()
    listar_scan()
    Cargar_Select_Tipo()

    $('.js-example-basic-single').select2();
    $(".summernote-simple").summernote({
        dialogsInBody: true,
        minHeight: 150,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['para', ['paragraph']]
        ]
    });
</script>