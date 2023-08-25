
function adicionarItem(idProduto) {
    //console.log(idProduto);

    //Criar a requisição
    var url = "pedidoController.php?action=addPed&id=" + idProduto;
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", url, true);

    xhttp.onload = function() {
        var retorno = xhttp.responseText;
        //console.log(retorno);

        if(retorno[0] == "{") { //Possui retorno JSON = produto encontrado
            //Converte o JSON em objeto JavaScript
            var produto = JSON.parse(retorno);
            
            //Caputurado o body da tabela
            var tabela = document.getElementById('tabProdCarrinho');
            var tabelaBodyArray = tabela.getElementsByTagName('tbody');
            var tabelaBody = tabelaBodyArray[0];

            //Criar linha na tabela
            var linha = tabelaBody.insertRow();
            criaColuna(linha, produto.nomeProduto);
            criaColuna(linha, produto.precoProduto);
            criaColuna(linha, produto.categoriaProduto);
            criaColuna(linha, produto.detalhes);

            

        } else { //Senão = exibe o erro
            var divErro = document.getElementById("divMsgErro");
            divErro.innerHTML = retorno;
            divErro.style.display = "block";
        }
    };

    //Enviar a requisição
    xhttp.send();

}

//Funçao para criar as colunas
function criaColuna(elemLinha, texto) {
    var col = elemLinha.insertCell();
    col.innerHTML = texto;
}