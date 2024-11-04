var usu_id = $('#usu_idx').val();

function init(){
    $("#externos_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#externos_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Voluntariado/controller/externo.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#externos_data').DataTable().ajax.reload();
            $('#modalcrearExternos').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro de forma correcta el usuario',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){

    $('#externos_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Voluntariado/controller/externo.php?opc=listar",
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
    $('#titulo_modal').html('Nuevo Usuario');
    $('#externos_form')[0].reset();
    $('#modalcrearExternos').modal('show');
}

function editar(ext_id){
    $.post("/Voluntariado/controller/externo.php?opc=mostrar",{ext_id:ext_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#ext_id').val(data.ext_id);
        $('#ext_nom').val(data.ext_nom);
        $('#ext_ape').val(data.ext_ape);
        $('#est_correo').val(data.est_correo);
        $('#est_telf').val(data.est_telf);

    });
    $('#titulo_modal').html('Editar un Usuario');
    $('#modalcrearExterno').modal('show');
}

function eliminar(ext_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Usuario?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Voluntariado/controller/externo.php?opc=eliminar",{ext_id:ext_id},function (data){
                $('#externos_data').DataTable().ajax.reload();
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
function est_act(ext_id){
    $.post("/Voluntariado/controller/externo.php?opc=activo",{ext_id:ext_id},function (data){
        $('#externos_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}

function est_ina(ext_id){
    $.post("/Voluntariado/controller/externo.php?opc=inactivo",{ext_id:ext_id},function (data){
        $('#externos_data').DataTable().ajax.reload();
    });
}

$(document).on("click", "#btnplantilla", function () {
    $('#modalExterno').modal('show');
});

var ExcelToJSON = function() {
    this.parseExcel = function(file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, {
                type: 'binary'
            });
            //TODO: Recorrido a todas las pestañas
            workbook.SheetNames.forEach(function(sheetName) {
                // Here is your object
                var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                var json_object = JSON.stringify(XL_row_object);
                ProfesorList = JSON.parse(json_object);

                console.log(ProfesorList)
                for (i = 0; i < ProfesorList.length; i++) {

                    var columns = Object.values(ProfesorList[i])

                    $.post("/Voluntario/controller/externo.php?opc=guardar_desde_excel",{
                        ext_nom : columns[0],
                        ext_ape : columns[1],
                        ext_correo : columns[2],
                        ext_telf : columns[3]
                    }, function (data) {
                        console.log(data);
                    });

                }
                /* TODO:Despues de subir la informacion limpiar inputfile */
                document.getElementById("upload").value=null;

                /* TODO: Actualizar Datatable JS */
                $('#externos_data').DataTable().ajax.reload();
                $('#modalExterno').modal('hide');
            })
        };
        reader.onerror = function(ex) {
            console.log(ex);
        };

        reader.readAsBinaryString(file);
    };
};

function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    var xl2json = new ExcelToJSON();
    xl2json.parseExcel(files[0]);
}

document.getElementById('upload').addEventListener('change', handleFileSelect, false);



init();