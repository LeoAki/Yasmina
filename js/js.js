document.write("<script type='text/javascript' src='jquery-1.7.2.min.js'></script>");
$(document).ready(function(){
    /*Event click button btnsave(value="GRABAR")*/
    $('#btnsave').click(function(evento){
        alert('EL REGISTRO SE HA GRABADO DE FORMA CORRECTA');
    })
    /*Event click button btndelete(value ELIMINAR)*/
    $('#btndelete').click(function(evento){
        //var a=('#txtid');
        alert('EL REGISTRO SE HA ELIMINADO');
    })

})


