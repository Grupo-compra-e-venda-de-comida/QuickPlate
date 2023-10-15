//Arquivo com as funcionalides de login

function logar() {
    var email = document.getElementById("txtEmail").value;
    var senha = document.getElementById("txtSenha").value;

    //Preparar a requisição POST
    var dados = new FormData();
    dados.append("email", email);
    dados.append("senha", senha);

    //Criar a requisição
    var url = "loginController.php?action=logon"
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", url, true);

    xhttp.onload = function() {
        var retorno = xhttp.responseText;
        console.log(retorno);

        if(retorno[0] == "{") { //Possui retorno JSON = login sucesso
            //Converte o JSON em objeto JavaScript
            var usuario = JSON.parse(retorno);
            
            if (usuario.tipoUsuario == 'C'){
                window.location = "homeController.php?action=homeCliente";
            }
            else if (usuario.tipoUsuario == 'V'){
                window.location = "homeController.php?action=homeVendedor";
            }
            else if(usuario.tipoUsuario == 'A'){
                window.location = "homeController.php?action=home";
            } else {
                var divErro = document.getElementById("divMsgErro");
                divErro.innerHTML = "Tipo de usuário inválido!";
                divErro.style.display = "block";    
            }

        } else { //Senão = exibe o erro
            var divErro = document.getElementById("divMsgErro");
            divErro.innerHTML = retorno;
            divErro.style.display = "block";
        }
    };

    //Enviar a requisição
    xhttp.send(dados);

}

function validar(){
    
    var label = document.getElementById("txtNome");
    var nome = document.getElementById("txtNome").value;
    var cliente = "Cliente";
    

    if(nome == cliente){
        label.classList.add('is-valid');
    }
    else{
        label.classList.add('is-invalid');
    }
    
}

function list(){

    window.location = "usuarioController.php?action=list";

}