function changeStatus(idPedido, status){
        //Criar a requisição
        var url = "pedidoController.php?action=updateStatus&idPedido=" + idPedido + "&status=" + status;
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", url, true);

        var label = document.getElementById("labelStatus" + idPedido);
    
        xhttp.onload = function() {
            if (status == "PP"){
                label.innerHTML = "preparando";
            }
            else if (status == "C"){
                label.innerHTML = "concluido";
            }
            else if (status == "E"){
                label.innerHTML = "entregue";
            }
            else if (status == "CC"){
                label.innerHTML = "cancelado";
                //cancel(idPedido);
            }
        };

        //Enviar a requisição
        xhttp.send();
}

function statusOptions() {
    //Criar a requisição
            var option = document.getElementById("statusOptions").value;
            var url = "pedidoController.php?action=statusFilter&option=" + option;
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", url, true);
    
        
            xhttp.onload = function() {
                var retorno = xhttp.responseText;

                console.log("aa");
            };
    
            //Enviar a requisição
            xhttp.send();

}
