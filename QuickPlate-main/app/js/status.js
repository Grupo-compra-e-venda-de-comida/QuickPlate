function changeStatus(idPedido, status){
        //Criar a requisição
        var url = "pedidoController.php?action=updateStatus&idPedido=" + idPedido + "&status=" + status;
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", url, true);

        var label = document.getElementById("labelStatus" + idPedido);
        var div = document.getElementById("status-tab-pane" + idPedido);
    
        xhttp.onload = function() {
            if (status == "PP"){
                label.innerHTML = "Preparando";
            }
            else if (status == "C"){
                label.innerHTML = "Concluido";
            }
            else if (status == "E"){
                label.innerHTML = "Entregue";
                div.innerHTML = "<span>Status do Pedido: Entregue </span><br>";
            }
            else if (status == "CC"){
                label.innerHTML = "Cancelado";
                div.innerHTML = "<span>Status do Pedido: Cancelado </span><br>";
            }
        };

        //Enviar a requisição
        xhttp.send();
}

function statusOptions(tipoUsuario) {
    var status = document.getElementById("statusOptions").value;
    var url = "";
    if(status){
        if(tipoUsuario == "C"){
            console.log("cliente detectado");
            url = "pedidoController.php?action=listPedCliente&status=" + status;
        } else if (tipoUsuario == "V"){
            url = "pedidoController.php?action=listPedVendedor&status=" + status;
        }
    } 
    else {
        if(tipoUsuario == "C"){
            url = "pedidoController.php?action=listPedCliente";
        } else if (tipoUsuario == "V"){
            url = "pedidoController.php?action=listPedVendedor";
        }
    }
        
    window.location = url;

}
