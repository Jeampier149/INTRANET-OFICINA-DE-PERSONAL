<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>DOCUMENTOS RECEPCIONADOS POR AREA</h4>
        </div>
        <div class="card-body">
            <div class="contenido mb-4">
                <div class="row d-flex  align-items-center justify-content-around">
                    <div class="col-lg-3">
                        <label for="">Fecha Inicio</label>
                        <input type="date" name="fechai" id="fecha_inicio" class="form-control">
                    </div>
                    <div class="col-lg-3">
                        <label for="">Fecha Fin</label>
                        <input type="date" name="fechaf" id="fecha_fin" class="form-control">
                    </div>
                    <div class="col-lg-2">
                       &nbsp;
                        <button class="btn btn-primary" style="width:100%" onclick="listar_tramite()"><i class="glyphicon glyphicon-search"> </i> Buscar</button>
                    </div>
                    <div class="col-lg-2">
                       &nbsp;
                        <button class="btn btn-primary" style="width:100%" ><i class="glyphicon glyphicon-search"> </i>  Docs Enviados</button>
                    </div>
                    <div class="col-lg-2">
                       &nbsp;
                       <button class="btn btn-primary" style="width: 100%;" onclick="cargar_contenido('contenido_principal','registro_tramite.php')">Nuevo</button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control global_filter" id="global_filter">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="tabla_tramite" class="display responsive table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nro Seguimiento</th>
                            <th>Nro Doc</th>
                            <th>Tipo Doc</th>
                            <th>Aréa Origen</th>
                            <th>Aréa Localizado</th>
                            <th>Mas Datos</th>
                            <th>Seguimiento</th>
                            <th>Estado Documento</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script src="../js/console_tramite_area.js"></script>
<div class="modal fade" id="modal_mdatos" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <h4>DATOS DEL DOCUMENTO</h5>
                    </div>
                    <div class="card-body">

                        <table style=" border-spacing: 20px;border-collapse: separate;">
                            <tr>
                                <td><b>Remitente</b></td>
                                <td>Alfredo Benavides Duarez</td>
                            </tr>
                            <tr>
                                <td><b>Asunto</b></td>
                                <td>El tardofranquismo constituye la última etapa de la dictadura franquista que termina con la muerte de Francisco Franco el 20 de noviembre de 1975. Se suele situar su comienzo en octubre de 1969 cuando se forma el gobierno «monocolor» presidido</td>
                            </tr>
                            <tr>
                                <td><b>Archivo</b></td>

                            </tr>

                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_historial" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <h4>DOCUMENTOS ENVIADOS</h5>
                    </div>
                    <div class="card-body">
                    <table id="tabla_historial" class="display responsive table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nro Doc</th>
                            <th>Tipo Doc</th>
                            <th>Aréa Localizado</th>
                            <th>Estado Documento</th>
                            <th>Documento</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                      
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<script>
    fechadefault()
    listar_tramite()

</script>