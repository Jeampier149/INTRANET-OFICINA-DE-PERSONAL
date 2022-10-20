<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>RESUMEN</h4>
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
                <table id="tabla_resumen" class="display responsive nowrap table" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Año</th>
                            <th>Mes</th>
                            <th>archivo</th>
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
<div class="modal fade" tabindex="-1" role="dialog" id="registrar_resumen">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">NUEVO RESUMEN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive-xl text-nowrap">
                    <form id="formPlh" class="p-4">
                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <label for="year">Año</label>
                                    <input type="text" class="form-control" id="year" maxlength="4">
                                </div>
                                <div class="col-12 mt-2">
                                    <label for="month">Mes</label>
                                    <select class="form-control" id="month">
                                        <option value="">Seleccione un mes</option>
                                        <option value="ENERO">Enero</option>
                                        <option value="FEBRERO">Febrero</option>
                                        <option value="MARZO">Marzo</option>
                                        <option value="ABRIL">Abril</option>
                                        <option value="MAYO">Mayo</option>
                                        <option value="JUNIO">Junio</option>
                                        <option value="JULIO">Julio</option>
                                        <option value="AGOSTO">Agosto</option>
                                        <option value="SEPTIEMBRE">Septiembre</option>
                                        <option value="OCTUBRE">Octubre</option>
                                        <option value="NOVIEMBRE">Noviembre</option>
                                        <option value="DICIEMBRE">Diciembre</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-2">
                                    <label for="fileplh">Archivo DatosPLH</label>
                                    <input type="file" class="form-control" id="fileplh">
                                </div>
                            </div>
                        </div>
                       
                    </form>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-primary" onclick="generateResume()">GENERAR</button>
            </div>
        </div>
    </div>
</div>
<script src="../js/console_resumen.js"></script>
<script>
   
</script>