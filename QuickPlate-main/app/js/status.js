function changeStatus(idPedido, status){
        //Criar a requisição
        var url = "pedidoController.php?action=updateStatus&idPedido=" + idPedido + "&status=" + status;
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", url, true);

        var label = document.getElementById("labelStatus" + idPedido);
    
        xhttp.onload = function() {
            label.innerHTML = status;
            //console.log(url);
        };

        //Enviar a requisição
        window.location = url;
}