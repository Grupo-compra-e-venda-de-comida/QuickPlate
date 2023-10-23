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
    console.log("teste statusOptions");
            //Criar a requisição
            /*var url = "pedidoController.php?action=statusFilter&option=" + option;
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", url, true);
    
            var option = document.getElementById("statusOptions").value;
        
            xhttp.onload = function() {

            };
    
            //Enviar a requisição
            window.location(url);
            //xhttp.send();*/
    
}
