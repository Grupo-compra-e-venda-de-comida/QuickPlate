function reviewOptions(tipoUsuario) {
    var aval = document.getElementById("reviewOptions").value;
    var url = "";
    if(review){
        if(tipoUsuario == "C"){
            console.log("cliente detectado");
            url = "reviewController.php?action=listReview&id=" + idVendedor + "&aval=" + aval;
        } /*else if (tipoUsuario == "V"){
            url = "pedidoController.php?action=listPedVendedor&status=" + status;
        }*/
    } 
    else {
        if(tipoUsuario == "C"){
            url = "reviewController.php?action=listReview&id=" + idVendedor;
        } /*else if (tipoUsuario == "V"){
            url = "pedidoController.php?action=listPedVendedor";
        }*/
    }
        
    window.location = url;

}
