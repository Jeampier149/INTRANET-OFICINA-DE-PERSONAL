function Iniciar_Sesion(){

    let usu = document.getElementById('txt_usuario').value;
    let con = document.getElementById('txt_contra').value;
    if(usu.length==0 || con.length==0){
        return Swal.fire({
            icon: 'warning',
            title: 'Mensaje de Advertencia',
            text: 'Llene los campos de la sesion',
            heightAuto:false
        });
    } 

    $.ajax({
        url:'controller/usuarioC.php?tipo=iniciar',
        type:'POST',
        data:{
            u:usu,
            c:con,          
        }
    }).done(function(resp){     
        let data = JSON.parse(resp);  
        if(data.length>0){
            if(data[0][7]=="INACTIVO"){
                return Swal.fire({
                    icon: 'warning',
                    title: 'Mensaje de Advertencia',
                    text: 'El usuario '+usu+' se encuentra inactivo',
                    heightAuto:false
                });
            }
            $.ajax({
                url:'controller/usuarioC.php?tipo=crear_s',
                type:'POST',
                data:{
                    idusuario:data[0][0],
                    usuario:data[0][1],
                    rol:data[0][9],
                    area:data[0][8],

                }
            }).done(function(r){
                let timerInterval
                Swal.fire({
                  title: 'Bienvenido al sistema!',
                  html: 'Seeras redireccionado en <b></b> milliseconds.',
                  timer: 2000,
                  timerProgressBar: true,
                  heightAuto:false,
                  didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                      b.textContent = Swal.getTimerLeft()
                    }, 100)
                  },
                  willClose: () => {
                    clearInterval(timerInterval)
                  }
                }).then((result) => {
                  /* Read more about handling dismissals below */
                  if (result.dismiss === Swal.DismissReason.timer) {
                    location.reload();
                  }
                })
            })
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Mensaje de Advertencia',
                text: 'Usuario o contraseña incorrecta',
                heightAuto:false
            });
        }
    })
}



var  tbl_usuario;
function listar_usuario(){
    tbl_usuario = $("#tabla_usuario").DataTable({
        "ordering":true,   
        "bLengthChange":true,
        "searching": { "regex": false },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "destroy":true,
        "processing": true,
        "responsive": true,
        "autoWidth": false,
        "ajax":{
            "url":"../controller/usuarioC.php?tipo=listar",
            type:'POST'
        },
        "columns":[
            {"defaultContent":""},
            {"data":"usu_usuario"},
            {"data":"area_nombre"},
            {"data":"usu_rol"},
            {"data":"nempleaddo"},
            {"data":"usu_estatus",
                render: function(data,type,row){
                        if(data=='ACTIVO'){
                        return '<span class="badge badge-success">ACTIVO</span>';
                        }else{
                        return '<span class="badge badge-danger">INACTIVO</span>';
                        }
                }   
            },
            {"data":"usu_estatus",
                render: function(data,type,row){
                        if(data=='ACTIVO'){
                        return `<button class='editar btn btn-primary btn-sm'><i class='fa fa-edit'></i></button>
                                 <button class='contra btn btn-sm'><i class='fas fa-key'></i></button>
                                <button class='desactivar btn danger btn-sm'><i class='fa fa-times-circle'></i></button>`
                        }else{
                            return `<button class='editar btn btn-primary btn-sm'><i class='fa fa-edit'></i></button>
                                    <button class='contra btn btn-sm'><i class='fas fa-key'></i></button>
                                    <button class='activar btn success btn-sm'><i class='fa fa-check-circle'></i></button>
                                    `
                        }
                }   
            }
            
        ],
        select: true
    });
    tbl_usuario.on('draw.td',function(){
      var PageInfo = $("#tabla_usuario").DataTable().page.info();
      tbl_usuario.column(0, {page: 'current'}).nodes().each(function(cell, i){
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    });
    
    document.getElementById('tabla_usuario_filter').style.display = "none";
    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'));
    });
}
function filterGlobal() {
    $('#tabla_usuario').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}
$('#tabla_usuario').on('click','.editar',function(){
	var data = tbl_usuario.row($(this).parents('tr')).data();//En tamaño escritorio
	if(tbl_usuario.row(this).child.isShown()){
		var data = tbl_usuario.row(this).data();
	}//Permite llevar los datos cuando es tamaño celular y usas el responsive de datatable
    $("#modal_editar").modal('show');
    document.getElementById('txt_idusuario').value=data.usu_id;
    $("#select_empleado_editar").select2().val(data.empleado_id).trigger('change.select2');
    $("#select_area_editar").select2().val(data.area_id).trigger('change.select2');
    $("#select_rol_editar").select2().val(data.usu_rol).trigger('change.select2');
})

$('#tabla_usuario').on('click','.contra',function(){
	var data = tbl_usuario.row($(this).parents('tr')).data();//En tamaño escritorio
	if(tbl_usuario.row(this).child.isShown()){
		var data = tbl_usuario.row(this).data();
	}//Permite llevar los datos cuando es tamaño celular y usas el responsive de datatable
    $("#modal_contra").modal('show');
    document.getElementById('txt_idusuario_contra').value=data.usu_id;

})

$('#tabla_usuario').on('click','.desactivar',function(){
	var data = tbl_usuario.row($(this).parents('tr')).data();//En tamaño escritorio
	if(tbl_usuario.row(this).child.isShown()){
		var data = tbl_usuario.row(this).data();
	}//Permite llevar los datos cuando es tamaño celular y usas el responsive de datatable
    Swal.fire({
        title: 'Desea desactivar al usuario '+data.usu_usuario+'?',
        text: "Una vez desactivo el usuario no tendra acceso al sistema!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI'
      }).then((result) => {
        if (result.isConfirmed) {
            Modificar_Estatus_Usuario(parseInt(data.usu_id),'INACTIVO',data.usu_usuario);
        }
    })

})

$('#tabla_usuario').on('click','.activar',function(){
	var data = tbl_usuario.row($(this).parents('tr')).data();//En tamaño escritorio
	if(tbl_usuario.row(this).child.isShown()){
		var data = tbl_usuario.row(this).data();
	}//Permite llevar los datos cuando es tamaño celular y usas el responsive de datatable
    Swal.fire({
        title: 'Desea activar al usuario '+data.usu_usuario+'?',
        text: "Una vez activar el usuario tendra acceso al sistema!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI'
      }).then((result) => {
        if (result.isConfirmed) {
            Modificar_Estatus_Usuario(parseInt(data.usu_id),'ACTIVO',data.usu_usuario);
        }
    })

})

function AbrirRegistro(){
    $("#modal_registro").modal({backdrop:'static',keyboard:false})
    $("#modal_registro").modal('show');
}

function Registar_Usuario(){
    let usu = document.getElementById('txt_usu').value;
    let con = document.getElementById('txt_con').value;
    let ide = document.getElementById('select_empleado').value;
    let ida = document.getElementById('select_area').value;
    let rol = document.getElementById('select_rol').value;
    if(usu.length==0 || con.length==0 || ide.length==0 || ida.length==0 || rol.length==0 ){
        return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
    }

    $.ajax({
        "url":"../controller/usuarioC.php?tipo=registrar",
        type:'POST',
        data:{
            usu:usu,
            con:con,
            ide:ide,
            ida:ida,
            rol:rol
        }
    }).done(function(resp){
        if(resp>0){
            if(resp==1){
                Swal.fire("Mensaje de Confirmacion","Nuevo Usuario Registrado","success").then((value)=>{
                    document.getElementById('txt_usu').value="";
                    document.getElementById('txt_con').value="";
                    document.getElementById('select_empleado').value="";
                    document.getElementById('select_area').value="";
                    document.getElementById('select_rol').value="";
                    tbl_usuario.ajax.reload();
                    $("#modal_registro").modal('hide');
                });
            }else{
                Swal.fire("Mensaje de Advertencia","El Usuairo ingresado ya se encuentra en la base de datos","warning");
            }
        }else{
            return Swal.fire("Mensaje de Error","No se completo el registro","error");            
        }
    })
}

function Modificar_Usuario(){
    let id  = document.getElementById('txt_idusuario').value;
    let ide = document.getElementById('select_empleado_editar').value;
    let ida = document.getElementById('select_area_editar').value;
    let rol = document.getElementById('select_rol_editar').value;
    if(id.length==0 || ide.length==0 || ida.length==0 || rol.length==0 ){
        return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
    }

    $.ajax({
        "url":"../controller/usuarioC.php?tipo=modificar",
        type:'POST',
        data:{
            id:id,
            ide:ide,
            ida:ida,
            rol:rol
        }
    }).done(function(resp){
        if(resp>0){
                Swal.fire("Mensaje de Confirmacion","Datos del usuario actualizados","success").then((value)=>{
                    tbl_usuario.ajax.reload();
                    $("#modal_editar").modal('hide');
                });
        }else{
            return Swal.fire("Mensaje de Error","No se completo la actualizacion","error");            
        }
    })
}

function Modificar_Usuario_Contra(){
    let id  = document.getElementById('txt_idusuario_contra').value;
    let con = document.getElementById('txt_contra_nueva').value;
    if(id.length==0 || con.length==0){
        return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
    }

    $.ajax({
        "url":"../controller/usuarioC.php?tipo=modificar_contra",
        type:'POST',
        data:{
            id:id,
            con:con
        }
    }).done(function(resp){
        if(resp>0){
                Swal.fire("Mensaje de Confirmacion","Contraseña del usuario actualizada","success").then((value)=>{
                    tbl_usuario.ajax.reload();
                    $("#modal_contra").modal('hide');
                });
        }else{
            return Swal.fire("Mensaje de Error","No se completo la actualizacion","error");            
        }
    })
}

function Modificar_Estatus_Usuario(id,estatus,user){
    let esta = estatus;
    if(esta=="INACTIVO"){
        esta="Desactivo";
    }
    $.ajax({
        "url":"../controller/usuarioC.php?tipo=modificar_estado",
        type:'POST',
        data:{
            id:id,
            estatus:estatus
        }
    }).done(function(resp){
        if(resp>0){
                Swal.fire("Mensaje de Confirmacion","Se "+esta+"  Con Exito El Usuario "+user,"success").then((value)=>{
                    tbl_usuario.ajax.reload();
                });
        }else{
            return Swal.fire("Mensaje de Error","No se completo la actualizacion","error");            
        }
    })
}

function Cargar_Select_Empleado(){
    $.ajax({
        "url":"../controller/usuarioC.php?tipo=cargar_select_emp",
        type:'POST'
    }).done(function(resp){
        let data = JSON.parse(resp);
        if(data.length>0){
            let cadena = "";
            for (let i = 0; i < data.length; i++) {
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            document.getElementById('select_empleado').innerHTML=cadena;
            document.getElementById('select_empleado_editar').innerHTML=cadena;

        }else{
            cadena+="<option value=''>No hay empleados disponibles</option>";
            document.getElementById('select_empleado').innerHTML=cadena;
            document.getElementById('select_empleado_editar').innerHTML=cadena;
        }
    })
}

function Cargar_Select_Area(){
    $.ajax({
        "url":"../controller/usuarioC.php?tipo=cargar_select_area",
        type:'POST'
    }).done(function(resp){
        let data = JSON.parse(resp);
        if(data.length>0){
            let cadena = "";
            for (let i = 0; i < data.length; i++) {
                cadena+="<option value='"+data[i][0]+"'>"+data[i][1]+"</option>";
            }
            document.getElementById('select_area').innerHTML=cadena;
            document.getElementById('select_area_editar').innerHTML=cadena;

        }else{
            cadena+="<option value=''>No hay empleados disponibles</option>";
            document.getElementById('select_area').innerHTML=cadena;
            document.getElementById('select_area_editar').innerHTML=cadena;
        }
    })
}


////seguimieto tramite/
function Traer_Datos_Seguimiento(){
    let numero  = document.getElementById('txt_numero').value;
    let dni     = document.getElementById('txt_dni').value;
    if(numero.length==0 || dni.length==0){
        return Swal.fire('Mensaje de Advertencia','Llene los campos vacios','warning');
    }
    $.ajax({
        "url":"controller/usuarioC.php?tipo=traer_data_segu",
        type:'POST',
        data:{
            numero:numero,
            dni:dni
        }
    }).done(function(resp){
        let data = JSON.parse(resp);
        var cadena="";
        if(data.length>0){
            document.getElementById("div_buscador").style.display = "block";
            document.getElementById('lbl_titulo').innerHTML="<b>Seguimiento del tramite "+data[0][0]+" - "+data[0][2]+"</b>";
             cadena += '<div class="timeline">'+
            '<div class="time-label">'+
                '<span class="bg-red">'+data[0][3]+'</span>'+
            '</div>';
            //AJAX PARA EL DETALLE DEL SEGUIMIENTO////
            $.ajax({
                "url":"controller/usuarioC.php?tipo=traer_data_detalle_segu",
                type:'POST',
                data:{
                   codigo:data[0][0]
                }
            }).done(function(resp){
                let datadetalle = JSON.parse(resp);
                if(datadetalle.length>0){
                    for (let i = 0; i < datadetalle.length; i++) {
                        cadena+=' <div>'+
                        '<i class="fas fa-envelope bg-blue"></i>'+
                        '<div class="timeline-item">'+
                        '<span class="time"><i class="fas fa-clock"></i>'+datadetalle[i][3]+'</span>'+
                        '<h3 class="timeline-header"><a href="#">El documento  fue derivado al area '+datadetalle[i][2]+'</a> - <b>Estatus: '+datadetalle[i][5]+' </b></h3>'+
                        '<div class="timeline-body">'+datadetalle[i][4]+''+
                        
                        '</div>'+
                        '</div>'+
                    '</div>';
                    } 
                    cadena+='</div>';
                    document.getElementById("div_seguimiento").innerHTML=cadena;
                }
            })

            /////////
        }else{
            document.getElementById("div_buscador").style.display = "none";
            
        }
    })
}

function traerDatosUsuario() {
    let usuario = $("#txtprincipalid").val();
    $.ajax({
        "url": '../controller/usuarioC.php?tipo=traer_data_usuario',
        type: "POST",
        data: {
            usuario: usuario

        }
    }).done(function (response) {
        var datos = JSON.parse(response);
        if (datos.length > 0) {
            $('.user-name').html(datos[0][1])
            $('#img_inicio').attr("src","../"+datos[0][9]);

        }

    })
}

function traerDatosProfile() {
    let usuario = $("#txtprincipalid").val();

    $.ajax({
        "url": '../controller/usuarioC.php?tipo=traer_data_usuario',
        type: "POST",
        data: {
            usuario: usuario

        }
    }).done(function (response) {
        var datos = JSON.parse(response);
   
        if (datos.length > 0) {
            $('.img-profile').attr("src","../"+datos[0][9]);
          
        }

    })
}