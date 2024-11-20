var usu_id = $('#usu_idx').val();
var rol_id = $('#rol_idx').val();

function init(){
    $("#lugares_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#lugares_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Voluntariado/controller/lugares.php?opc=guardaryeditar2",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#lugares_data').DataTable().ajax.reload();
            $('#modalcrearMiLugar').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro de forma correcta',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){
    $('#area_id').select2({
        dropdownParent: $('#modalcrearMiLugar')
    });

    combo_area();


    $('#lugares_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Voluntariado/controller/lugares.php?opc=listarxRol",
            type:"post"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 15,
        "order": [[ 0, "desc" ]],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });  

});

function nuevo(){
    $('#titulo_modal').html('Nuevo lugar');
    $('#lugares_form')[0].reset();
 /*    combo_area();

    combo_supervisor(); */
    $('#modalcrearMiLugar').modal('show');
}

function combo_area(){
    $.post("/Voluntariado/controller/area.php?opc=combo", function (data) {
        $('#area_id').html(data);
    });
}

function editar(lug_id){
    $.post("/Voluntariado/controller/lugares.php?opc=mostrar",{lug_id:lug_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#lug_id').val(data.lug_id);
        $('#area_id').val(data.area_id).trigger('change');
        $('#lug_nom').val(data.lug_nom);
        $('#lug_descrip').val(data.lug_descrip);
        $('#lug_fecini').val(data.lug_fecini);
        $('#lug_fecfin').val(data.lug_fecfin);
    });
    $('#titulo_modal').html('Editar lugares');
    $('#modalcrearMiLugar').modal('show');
}

function info(lug_id){
    $.post("/Voluntariado/controller/lugares.php?opc=mostrar",{lug_id:lug_id},function (data){
        data = JSON.parse(data);
        console.log(data);
       /*  $('#lug_id').val(data.lug_id);
        $('#area_id').val(data.area_id).trigger('change');
        $('#lug_nom').val(data.lug_nom); */
        $('#lug_descrip').val(data.lug_descrip);
        /* $('#lug_fecini').val(data.lug_fecini);
        $('#lug_fecfin').val(data.lug_fecfin);
        $('#ext_id').val(data.ext_id).trigger('change'); */
    });
    $('#titulo_modal').html('Información del lugar');
    $('#modalcrearLugarInfo').modal('show');
}


function eliminar(lug_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Voluntariado/controller/lugares.php?opc=eliminar",{lug_id:lug_id},function (data){
                $('#lugares_data').DataTable().ajax.reload();
                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se Elimino Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            }); 
        }
    });

}

function est_act(lug_id){
    $.post("/Voluntariado/controller/lugares.php?opc=activo",{lug_id:lug_id},function (data){
        $('#lugares_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}

function est_ina(lug_id){
    $.post("/Voluntariado/controller/lugares.php?opc=inactivo",{lug_id:lug_id},function (data){
        $('#lugares_data').DataTable().ajax.reload();
    });
}

function inscritos(lug_id){
    console.log(lug_id);
    window.open('detalle_lugar.php?ID='+ lug_id +'');
    /* mostrar_inscritos(lug_id); */
 
}

function mostrar_inscritos(lug_id){
    console.log(lug_id);
    /* const params = new URLSearchParams(window.location.search);
    const lug_id = params.get('ID'); */
    $.post("/Voluntariado/controller/lugares.php?opc=mostrar_lugares_usuario",{lug_id:lug_id},function (data){
        $('#inscritos_data').DataTable().ajax.reload();
    }); 
}

function est_ter(lug_id){
    $.post("/Voluntariado/controller/lugares.php?opc=terminado",{lug_id:lug_id},function (data){
        $('#inscritos_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}
function est_pro(lug_id){
    $.post("/Voluntariado/controller/lugares.php?opc=proceso",{lug_id:lug_id},function (data){
        $('#inscritos_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}
   

init();