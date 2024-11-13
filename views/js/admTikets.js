function init(){
   
}
var usu_id = $('#usu_idx').val();
$(document).ready(function(){
    var usu_id = $('#usu_idx').val();

    if ( $('#rol_idx').val() == "E"){
        $.post("/Aspirantes/controller/usuario.php?opc=total", {usu_id:usu_id}, function (data) {
            data = JSON.parse(data);
            $('#lbltotalTickets').html(data.TOTAL);
        }); 
    
        $.post("/Aspirantes/controller/usuario.php?opc=totalabierto", {usu_id:usu_id}, function (data) {
            data = JSON.parse(data);
            $('#lbltotalTicketsAbiertos').html(data.TOTAL);
        });
    
        $.post("/Aspirantes/controller/usuario.php?opc=totalcerrado", {usu_id:usu_id}, function (data) {
            data = JSON.parse(data);
            $('#lbltotalTicketsCerrados').html(data.TOTAL);
        });

    }else{
        $.post("/Aspirantes/controller/ticket.php?opc=total", function (data) {
            data = JSON.parse(data);
            $('#lbltotalTickets').html(data.TOTAL);
        }); 
    
        $.post("/Aspirantes/controller/ticket.php?opc=totalabierto", function (data) {
            data = JSON.parse(data);
            $('#lbltotalTicketsAbiertos').html(data.TOTAL);
        });
    
        $.post("/Aspirantes/controller/ticket.php?opc=totalcerrado", function (data) {
            data = JSON.parse(data);
            $('#lbltotalTicketsCerrados').html(data.TOTAL);
        });

    }

 
});

init();