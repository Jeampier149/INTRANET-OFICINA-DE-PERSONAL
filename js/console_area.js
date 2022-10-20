var  tbl_area;
function listar_area(){
    tbl_area = $("#tabla_area").DataTable({
        "ordering":true,   
        "bLengthChange":true,
        "searching": { "regex": false },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "destroy":true,
        "processing": true,
        "responsive": true,
        "autoWidth": false,
          select: true,
        "ajax":{
            "url":"../controller/areaC.php?tipo=listar",
            type:'POST'
        },
        "columns":[
            {"defaultContent":""},
            {"data":"area_nombre"},
            {"data":"area_fecha_registro"},
            {"data":"area_estado",
                render: function(data,type,row){
                        if(data=='ACTIVO'){
                        return '<span class="badge badge-success">ACTIVO</span>';
                        }else{
                        return '<span class="badge badge-danger">INACTIVO</span>';
                        }
                }   
            },
            {"defaultContent":"<button class='editar btn btn-primary'><i class='fa fa-edit'></i></button>"},
           
        ],
    });
    tbl_area.on('draw.td',function(){
      var PageInfo = $("#tabla_area").DataTable().page.info();
      tbl_area.column(0, {page: 'current'}).nodes().each(function(cell, i){
        cell.innerHTML = i + 1 + PageInfo.start;
      });
    });

    document.querySelector('#tabla_area_filter').style.display = "none";
    $('input.global_filter').on('keyup click', function () {
        filterGlobal();
    });
    $('input.column_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'));
    });

}

function filterGlobal() {
    $('#tabla_area').DataTable().search(
        $('#global_filter').val(),
    ).draw();
}

function abrir_modal(){
    $("#registrar_area").modal({backdrop:'static',keyboard:false})
    $("#registrar_area").modal('show');
}

function Registrar_Area(){
    let area = document.getElementById('txt_area').value;
    if(area.length==0){
        return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
    }

    $.ajax({
        "url":"../controller/areaC.php?tipo=registro",
        type:'POST',
        data:{
            a:area
        }
    }).done(function(resp){
        if(resp>0){
            if(resp==1){
                Swal.fire("Mensaje de Confirmacion","Nuevo Area Registrado","success").then((value)=>{
                    document.getElementById('txt_area').value="";
                    tbl_area.ajax.reload();
                    $("#registrar_area").modal('hide');
                });
            }else{
                Swal.fire("Mensaje de Advertencia","El area ingresada ya se encuentra en la base de datos","warning");
            }
        }else{
            return Swal.fire("Mensaje de Error","No se completo el registro","error");            
        }
    })
}
$('#tabla_area').on('click','.editar',function(){
	var data = tbl_area.row($(this).parents('tr')).data();//En tamaño escritorio
	if(tbl_area.row(this).child.isShown()){
		var data = tbl_area.row(this).data();
	}//Permite llevar los datos cuando es tamaño celular y usas el responsive de datatable
    $("#modal_editar").modal('show');
    document.getElementById('txt_area_editar').value=data.area_nombre;
    document.getElementById('txt_idarea').value=data.area_cod;
    document.getElementById('select_estatus').value=data.area_estado;
})

function Modificar_Area(){
    let id   = document.getElementById('txt_idarea').value;
    let area = document.getElementById('txt_area_editar').value;
    let esta = document.getElementById('select_estatus').value;
    if(area.length==0 || id.length==0){
        return Swal.fire("Mensaje de Advertencia","Tiene campos vacios","warning");
    }

    $.ajax({
        "url":"../controller/areaC.php?tipo=modificar",
        type:'POST',
        data:{
            id:id,
            are:area,
            esta:esta
        }
    }).done(function(resp){
        if(resp>0){
            if(resp==1){
                Swal.fire("Mensaje de Confirmacion","Datos Actualizados","success").then((value)=>{
                    tbl_area.ajax.reload();
                    $("#modal_editar").modal('hide');
                });
            }else{
                Swal.fire("Mensaje de Advertencia","El area ingresada ya se encuentra en la base de datos","warning");
            }
        }else{
            return Swal.fire("Mensaje de Error","No se completo la modificacion","error");            
        }
    })
}