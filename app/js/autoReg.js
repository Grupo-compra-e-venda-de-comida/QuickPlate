function mostrar(){
    console.log("teste");
    var tipo = document.getElementById("tipo");
    var div = document.getElementById("divTipoVend");

    if(tipo = "V"){
        div.style.display='block';
    } 
    if(tipo = "C"){
        div.style.display='none';
    }
}