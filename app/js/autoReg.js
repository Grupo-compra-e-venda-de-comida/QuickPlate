function mostrar(){
    var tipo = document.getElementById("tipo").value;
    var div = document.getElementById("divTipoVend");

    if(tipo = "V"){
        div.style.display='block';
        //console.log("block");
    } 
    else if(tipo = "C"){
        div.style.display='none';
        //console.log("none");
    }
}