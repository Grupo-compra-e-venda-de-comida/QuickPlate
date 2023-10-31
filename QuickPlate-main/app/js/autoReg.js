mostrar();

function mostrar(){
    var tipo = document.getElementById("tipo").value;
    var div = document.getElementById("divTipoVend");
    //console.log(tipo);

    if(tipo == "V"){
        div.style.display='block';
    } 
    else if(tipo == "C"){
        div.style.display='none';
    }
}