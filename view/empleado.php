<div class="card-header">
    <h4>EMPLEADOS</h4>
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
        <table id="tabla_empleado" class="display responsive  table" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>DNI</th>
                    <th>Empleado</th>
                    <th>Movil</th>
                    <th>Email</th>
                    <th>Dirección</th>
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
<script src="../js/console_empleado.js"></script>
<!-- Modal -->
<div class="modal fade" id="modal_registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRO DE EMPLEADO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" onsubmit="return false">
                    <div class="row">
                        <div class="row">
                            <div class="col-6">
                                <label for="">Nro Documento</label>
                                <input type="text" class="form-control" id="txt_nro">
                            </div>
                            <div class="col-6">
                                <label for="">Nombres</label>
                                <input type="text" class="form-control" id="txt_nom">
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-6">
                                <label for="">Apellido Paterno</label>
                                <input type="text" class="form-control" id="txt_apepa">
                            </div>
                            <div class="col-6">
                                <label for="">Apellido Materno</label>
                                <input type="text" class="form-control" id="txt_apema">
                            </div>
                        </div>
                        <div class="row  w-100">
                            <div class=" col-6">
                                <label>Fecha de nacimiento</label>
                                <input type="date" class="form-control" id="txt_fnac">
                            </div>
                            <div class="col-6">
                                <label for="">Movil</label>
                                <input type="text" class="form-control" id="txt_movil">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="">Dirección</label>
                                <input type="text" class="form-control" id="txt_dire">
                            </div>
                            <div class="col-6">
                                <label for="">Email</label>
                                <input type="text" class="form-control" id="txt_email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="">Subir Avatar</label><br>
                                <input type="file" id="imagen" accept="image/*" width="100%">

                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="Registrar_Empleado()">REGISTRAR</button>
            </div>

        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDITAR DATOS DE EMPLEADO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <input type="text" id="txt_idempleado" hidden>
                        <label for="">Nro Documento</label>
                        <input type="text" class="form-control" id="txt_nro_editar" onkeypress="return soloNumeros(event)">
                    </div>
                    <div class="col-8">
                        <label for="">Nombres</label>
                        <input type="text" class="form-control" id="txt_nom_editar" onkeypress="return soloLetras(event)">
                    </div>
                    <div class="col-6">
                        <label for="">Apellido Paterno</label>
                        <input type="text" class="form-control" id="txt_apepa_editar" onkeypress="return soloLetras(event)">
                    </div>
                    <div class="col-6">
                        <label for="">Apellido Materno</label>
                        <input type="text" class="form-control" id="txt_apema_editar" onkeypress="return soloLetras(event)">
                    </div>
                    <div class="col-6">
                        <label for="">Fecha Nacimiento</label>
                        <input type="date" class="form-control" id="txt_fnac_editar">
                    </div>
                    <div class="col-6">
                        <label for="">Movil</label>
                        <input type="text" class="form-control" id="txt_movil_editar" onkeypress="return soloNumeros(event)">
                    </div>
                    <div class="col-12">
                        <label for="">Dirección</label>
                        <input type="text" class="form-control" id="txt_dire_editar">
                    </div>
                    <div class="col-8">
                        <label for="">Email</label>
                        <input type="text" class="form-control" id="txt_email_editar">
                    </div>
                    <div class="col-4">
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
                <button type="button" class="btn btn-success" onclick="Modificar_Empleado()">MODIFICAR</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<script>
    $(document).ready(function() {
        listar_empleado();
    });
    $('#modal_registro').on('shown.bs.modal', function() {
        $('#txt_nro').trigger('focus')
    })
</script>