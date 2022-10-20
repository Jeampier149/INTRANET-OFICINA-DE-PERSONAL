<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>TIPO DE DOCUMENTOS</h4>
        </div>
        <div class="card-body">
            <div class="contenido mb-4">
                <div class="row">
                    <div class="col-md-9 col-12 mb-2 mb-md-0">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control global_filter" id="global_filter">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">
                        <button class="btn btn-primary" style="width: 100%;" onclick="AbrirRegistro()">Nuevo</button>
                    </div>
                </div>
                    <table id="tabla_tipo" class="display responsive nowrap table" style="width:100%">
                        <thead>
                        <tr>
                          <th>#</th>
                          <th>Tipo Documento</th>
                          <th>Fecha Registro</th>
                          <th>Estatus</th>
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
<script src="../js/console_tipodocumento.js"></script>

<div class="modal fade" id="modal_registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">REGISTRO DE TIPO DE DOCUMENTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <label for="">TIPO DOCUMENTO</label>
                <input type="text" class="form-control" id="txt_tipo">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="Registrar_Tipo()">REGISTRAR</button>
      </div>
    </div>
  </div>
</div>    
<!-- Modal -->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDITAR DATOS DE TIPO DOCUMENTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <label for="">TIPO</label>
                <input type="text" class="form-control" id="txt_tipo_editar">
                <input type="text" id="txt_idtipo" hidden>
            </div>
            <div class="col-12">
                <label for="">Estatus</label>
                  <select name="" id="select_estatus" class="form-control">
                      <option value="ACTIVO">ACTIVO</option>
                      <option value="INACTIVO">INACTIVO</option>
                  </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="Modificar_Tipo()">MODIFICAR</button>
      </div>
    </div>
  </div>
</div>   

    <script>
      $(document).ready(function() {
        listar_tipodocumento();
      } );
      $('#modal_registro').on('shown.bs.modal', function () {
        $('#txt_tipo').trigger('focus')
       })
    </script>

