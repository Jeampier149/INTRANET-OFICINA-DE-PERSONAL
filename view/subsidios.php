
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>SUBSIDIOS</h4>
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
                        <button class="btn btn-primary" style="width: 100%;" onclick="abrir_modal()">Nuevo</button>
                    </div>
                </div>
                <table id="tabla_area" class="display responsive nowrap table" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Area</th>
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
<script src="../js/console_subsidio.js"></script>
<div class="modal fade" tabindex="-1" role="dialog" id="registrar_area">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">NUEVA AREA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="col-12">
                <label for="">AREA</label>
                <input type="text" class="form-control" id="txt_area">
            </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-primary" onclick="Registrar_Area()">REGISTRAR</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Editar -->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDITAR DATOS DE AREA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <label for="">AREA</label>
                <input type="text" class="form-control" id="txt_area_editar">
                <input type="text" id="txt_idarea" hidden>
            </div>
            <div class="col-12">
                <label for="">Estatus</label>
                  <select name="" id="select_estatus"  class="js-example-basic-single">
                      <option value="ACTIVO">ACTIVO</option>
                      <option value="INACTIVO">INACTIVO</option>
                  </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="Modificar_Area()">MODIFICAR</button>
      </div>
    </div>
  </div>
</div>   
<!-- end modal -->

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        
    });
</script>