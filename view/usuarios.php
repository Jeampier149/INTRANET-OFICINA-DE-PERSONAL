<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>USUARIOS</h4>
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
                        <button class="btn btn-primary" style="width: 100%;"  onclick="AbrirRegistro()">Nuevo</button>
                    </div>
                </div>
                <table id="tabla_usuario" class="display responsive  table" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Area</th>
                            <th>Rol</th>
                            <th>Empleado</th>
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
<!-- modal agregar usuario -->
<script src="../js/console_usuario.js"></script>

<div class="modal fade" id="modal_registro"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">REGISTRO DE USUARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-6">
                <label for="">USUARIO</label>
                <input type="text" class="form-control" id="txt_usu">
            </div>
            <div class="col-6">
                <label for="">CONTRASEÑA</label>
                <input type="password" class="form-control" id="txt_con">
            </div>
            <div class="col-12 mt-1">
              <label for="">EMPLEADO</label>
              <select class="js-example-basic-single" id="select_empleado" style="width:100%">
              </select>
            </div>
            <div class="col-6 mt-2">
              <label for="">AREA</label>
              <select class="js-example-basic-single" id="select_area" style="width:100%">
              </select>
            </div>
            <div class="col-6 mt-2">
              <label for="">ROL</label>
              <select class="js-example-basic-single" id="select_rol" style="width:100%">
                <option value="Secretario (a)">SECRETARIO(A)</option>
                <option value="Administrador">ADMINISTRADOR</option>
              </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="Registar_Usuario()">REGISTRAR</button>
      </div>
    </div>
  </div>
</div>    

<!-- modal editar usuario -->
<div class="modal fade" id="modal_editar"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDITAR DATOS DE USUARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <label for="">USUARIO</label>
                <input type="text" class="form-control" id="txt_usu_editar" disabled>
                <input type="text" id="txt_idusuario" hidden>
            </div>
            <div class="col-12">
              <label for="">EMPLEADO</label>
              <select class="js-example-basic-single" id="select_empleado_editar" style="width:100%">
              </select>
            </div>
            <div class="col-6">
              <label for="">AREA</label>
              <select class="js-example-basic-single" id="select_area_editar" style="width:100%">
              </select>
            </div>
            <div class="col-6">
              <label for="">ROL</label>
              <select class="js-example-basic-single" id="select_rol_editar" style="width:100%">
                <option value="Secretario (a)">SECRETARIO(A)</option>
                <option value="Administrador">ADMINISTRADOR</option>
              </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="Modificar_Usuario()">MODIFICAR</button>
      </div>
    </div>
  </div>
</div>    

    <!-- Modal -->
    <div class="modal fade" id="modal_contra"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EDITAR CONTRASEÑA DE USUARIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <label for="">CONTRASEÑA</label>
                <input type="password" class="form-control" id="txt_contra_nueva">
                <input type="text" id="txt_idusuario_contra" hidden>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="Modificar_Usuario_Contra()">MODIFICAR</button>
      </div>
    </div>
  </div>
</div>    
<!-- Modal -->
<script>

    $(document).ready(function() {
        listar_usuario()
        $('.js-example-basic-single').select2();
        Cargar_Select_Empleado();
        Cargar_Select_Area();
    });
</script>