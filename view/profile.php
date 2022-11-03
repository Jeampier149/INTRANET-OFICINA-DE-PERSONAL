<div class="section-body">
    <h2 class="section-title">Hola, Ujang!</h2>
    <p class="section-lead">
        Actualizar información.
    </p>

    <div class="row mt-sm-4">
        <div class="col-lg-3 col-12">
            <div class="card profile-widget">
                <div class="profile-widget-header">
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return false">
                        <div class="row">
                            <div class=" col-12 ">
                                <div class="col-12 mb-3">
                                    <img alt="image" src="" class="rounded-circle profile-widget-picture mb-3 img-profile " style="width:150px">
                                </div>
                                <div class="col-12 ">
                                    <input type="file" class="form-control" id="img-profile-edit">
                                </div>
                                <div class="col-12 mt-3">
                                    <button class="btn btn-info btn-rounded w-100 " onclick="actualizar_imagen_profile()"><i class="fa fa-plus"></i> Actualizar</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-12">
            <div class="card">
                <form method="post" class="needs-validation" novalidate="">
                    <div class="card-header">
                        <h4>Editar Perfil</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <input type="text" id="txt_idempleado" hidden>
                                <label for="">Nro Documento</label>
                                <input type="text" class="form-control" id="txt_dni" >
                            </div>
                            <div class="col-md-6">
                                <label for="">Nombres</label>
                                <input type="text" class="form-control" id="txt_nombre" >
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="">Apellido Paterno</label>
                                <input type="text" class="form-control" id="txt_app" >
                            </div>
                            <div class="col-md-6">
                                <label for="">Apellido Materno</label>
                                <input type="text" class="form-control" id="txt_apm">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="">Fecha Nacimiento</label>
                                <input type="date" class="form-control" id="txt_fnac">
                            </div>
                            <div class="col-md-6">
                                <label for="">Movil</label>
                                <input type="text" class="form-control" id="txt_cel" onkeypress="return soloNumeros(event)">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="">Email</label>
                                <input type="text" class="form-control" id="txt_correo">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button class="btn btn-primary refresh-profile">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
    traerDatosProfile()
    traerDatosUsuario()

</script>