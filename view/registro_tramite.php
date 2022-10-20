
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4>REGISTRO DE TRAMITE</h4>
        </div>
        <div class="card-body">
            <div class="contenido mb-4">
                <div class="row">

                    <div class="card-body">
                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true">DATOS DEL REMITENTE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false">DATOS DEL DOCUMENTO</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active " id="home3" role="tabpanel" aria-labelledby="home-tab3">
                                <div class="row mt-4">
                                    <div class="col-6 form-group">
                                        <label for="" style="font-size:small;">DNI</label>
                                        <input type="text" class="form-control" id="txt_dni">
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="" style="font-size:small;">NOMBRE</label>
                                        <input type="text" class="form-control" id="txt_nom">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 form-group">
                                        <label for="" style="font-size:small;">APELLIDO PATERNO</label>
                                        <input type="text" class="form-control" id="txt_apepat">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label for="" style="font-size:small;">APELLIDO MATERNO</label>
                                        <input type="text" class="form-control" id="txt_apemat">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 form-group">
                                        <label for="" style="font-size:small;">CELULAR</label>
                                        <input type="text" class="form-control" id="txt_celular">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label for="" style="font-size:small;">EMAIL</label>
                                        <input type="text" class="form-control" id="txt_email">
                                    </div>
                                </div>
                                <div class="col-12 d-none">
                                    <label for="" style="font-size:small;">DIRECCIÓN</label>
                                    <input type="text" class="form-control" id="txt_dire">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                <div class="row mt-4">
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="" style="font-size:small;">PROCEDENCIA DEL DOCUMENTO</label>
                                        <select class="js-example-basic-single" id="select_area_p" style="width:100%">
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="" style="font-size:small;">AREA DE DESTINO</label>
                                        <select class="js-example-basic-single" id="select_area_d" style="width:100%">
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="" style="font-size:small;">TIPO DOCUMENTO</label>
                                        <select class="js-example-basic-single" id="select_tipo" style="width:100%">
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6 form-group">
                                        <label for="" style="font-size:small;">Nº DOCUMENTO</label>
                                        <input type="text" class="form-control" id="txt_ndocumento">
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-12">                
                                        <label for="" style="font-size:small;">ASUNTO DEL TRAMITE</label>
                                        <textarea name="" class="summernote-simple" id="txt_asunto" cols="30" rows="10"></textarea>
                                        
                                    </div>
                                </div>
                                <div class="row " >
                                    <div class="col-8 form-group">
                                        <label for="" style="font-size:small;">Adjuntar documento</label>
                                        <input type="file" class="form-control" id="txt_archivo">
                                    </div>
                                    <div class="col-4 form-group">
                                        <label for="" style="font-size:small;">Nº FOLIOS</label>
                                        <input type="text" class="form-control" id="txt_folio">
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button class="btn  btn-success btn-lg" onclick="Registrar_Tramite()" id="btn_registro">REGISTRAR TRAMITE</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="../js/console_tramite.js"></script>
<script>

    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        Cargar_Select_Area()
        Cargar_Select_Tipo()

        $(".summernote-simple").summernote({
       dialogsInBody: true,
      minHeight: 150,
      toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['para', ['paragraph']]
      ]
    });
    });
</script>

</body>

</html>