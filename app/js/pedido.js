
var QTD_ID = 'CAMPO_QTD_';
var TOTAL_ID = 'CAMPO_TOTAL_';

function adicionarItem(idProduto) {

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

            //Verificar se o produto já foi adiconar na tabela
            var inputQtdProduto = document.querySelector('#' + QTD_ID + produto.id);
            if(inputQtdProduto) { //Se encontrou, apenas altera a quantidade e o total
                inputQtdProduto.value++; 

                var inputTotalProduto = document.querySelector('#' + TOTAL_ID + produto.id);
                inputTotalProduto.value = inputQtdProduto.value * produto.precoProduto;
            
            } else { //Senão, insere um novo produto

                //Caputurado o body da tabela
                var tabela = document.getElementById('tabProdCarrinho');
                var tabelaBodyArray = tabela.getElementsByTagName('tbody');
                var tabelaBody = tabelaBodyArray[0];

                //Criar linha na tabela
                var linha = tabelaBody.insertRow();
                criaColuna(linha, produto.nomeProduto);
                criaColuna(linha, produto.categoriaDesc);
                criaColuna(linha, produto.detalhes);
                criaColuna(linha, produto.precoProduto);
                criarColunaQtd(linha, produto.id);
                criarColunaTotal(linha, produto.id, produto.precoProduto);
                criarBotaoRemover(linha);

                calcTotalPedido();
            }

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

function criarColunaQtd(elemLinha, idProduto) {
    let input = document.createElement('input');
    input.setAttribute('type', 'number');
    input.setAttribute('class', 'form-control');
    input.setAttribute('type', "number");
    input.setAttribute('id', QTD_ID+idProduto);
    input.style.width = "60px";
    input.value = 1;
    
    var col = elemLinha.insertCell();
    col.appendChild(input);
}

function criarColunaTotal(elemLinha, idProduto, preco) {
    let input = document.createElement('input');
    input.setAttribute('type', 'number');
    input.setAttribute('class', 'form-control');
    input.setAttribute('readonly', "");
    input.setAttribute('id', TOTAL_ID+idProduto);
    input.style.width = "90px";
    input.value = preco;
    
    var col = elemLinha.insertCell();
    col.appendChild(input);
}

function criarBotaoRemover(elemLinha) {
    let btn = document.createElement('button');
    btn.setAttribute('type', 'button');
    btn.setAttribute('class', 'btn btn-danger');
    btn.innerHTML = 'Remover';

    btn.addEventListener("click", function() { 
        elemLinha.remove(); 
    });
    
    var col = elemLinha.insertCell();
    col.appendChild(btn);
}

function calcTotalPedido() {

    var precoTotal = 0;
    //var nodeTotal = document.querySelectorAll(TOTAL_ID);
    var arraysTotal = document.querySelectorAll("[id^='CAMPO_TOTAL_']");

    arraysTotal.forEach((p) => precoTotal = precoTotal + p.value);

    //var precoTotal = 1 + 2;
    console.log(arraysTotal);

    //var precoT = precoT + preco;
    var label = document.querySelector("#total");

    label.textContent = precoTotal;
} 