<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>DOCUMENTOS ENVIADOS</h4>
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
                        <button class="btn btn-primary" style="width:100%" onclick="listar_tramites_enviados()"><i class="glyphicon glyphicon-search"> </i> Buscar</button>
                    </div>
                    
                </div>
                <div class="row mt-3">
                    <div class="col-10">
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
                     
                       <button class="btn btn-primary" style="width: 100%;" onclick="">Nuevo</button>
                    </div>
                </div>
                <table id="tabla_tramite_enviado" class="display responsive table" style="width:100%">
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


<script>
    fechadefault()
    listar_tramites_enviados()

</script>