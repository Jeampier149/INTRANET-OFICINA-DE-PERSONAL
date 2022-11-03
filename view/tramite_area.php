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
                        <button class="btn btn-primary" onclick="cargar_contenido('contenido_principal','tramite_enviado.php')" style="width:100%"><i class="glyphicon glyphicon-search"> </i> Docs Enviados</button>
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
                            <th>Mas Datos</th>
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
<div class="modal fade" id="modal_mas" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">MAS DATOS DEL DOCUMENTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card">
                    <div class="card-body">

                        <table style=" border-spacing: 20px;border-collapse: separate;">
                            <tr>
                                <td><p><b>Remitente</b></p></td>
                                <td><p id="remitente"> </p> </td>
                            </tr>
                            <tr>
                                <td><p><b>Asunto</b>/p></td>
                                <td><p id="asunto_mas"></p> </td>
                            </tr>
                            <tr>
                                <td><b>Archivo</b></td>
                                <td><a href="#" type="button"  class="btn btn-primary"id="dow" target="_blank"><i class="fas fa-file-alt"></i> Descargar archivo</a></td>

                            </tr>

                        </table>
                    </div>
                   
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
<div class="modal fade" id="modal_derivar"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="lbl_titulo_derivar">
        </h5>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-6 form-group">
                <label for="">Fecha Registro:</label>
                <input type="text" id="txt_fecha_de" class="form-control" readonly style="background-color:white">
            </div>
            <div class="col-6">
                <label for="" style="font-size:small;">Acción:</label>
                <select class="js-example-basic-single" id="select_derivar_de" style="width:100%;">
                    <option value="DERIVAR">DERIVAR</option>
                    <option value="FINALIZAR">FINALIZAR</option>
                </select>
            </div>
              
            <div class="col-6 form-group div_derivacion">
                  <label for="">Área Origen:</label>
                  <input type="text" id="txt_origen_de" class="form-control" readonly style="background-color:white;width:100%">
            </div>
            <div class="col-6 form-group div_derivacion">
                <label for="">Área Destino:</label>
                <select class="js-example-basic-single" id="select_destino_de" style="width:100%;">
                    
                </select>
            </div>
            <div class="col-12 form-group">
                <label for="">Anexar documento</label>
                <input type="file" id="txt_documento_de" class="form-control">
            </div>
            <div class="col-12">
              <label for="">Descripción:</label>
              <textarea id="txt_descripcion_de" rows="3" class="form-control" style="resize:none;"></textarea>
            </div>
            <input type="text" name="" id="txt_idocumento_de" hidden>
            <input type="text" id="txt_idareorigen" hidden>
      
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="Registrar_Derivacion()">Registrar</button>
      </div>
    </div>
  </div>
</div>  

<script>
     $('.js-example-basic-single').select2();
    fechadefault()
    listar_tramite()
</script>