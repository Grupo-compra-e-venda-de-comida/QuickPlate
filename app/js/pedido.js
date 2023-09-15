var QTD_ID = 'CAMPO_QTD_';
var TOTAL_ID = 'CAMPO_TOTAL_';
var TOTAL_PEDIDO = 0;
var TOTAL_ANTERIOR = 0;

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
                calcTotalPedido(produto.precoProduto);
            
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
                criarColunaQtd(linha, produto.id, produto.precoProduto);
                criarColunaTotal(linha, produto.id, produto.precoProduto);
                criarBotaoRemover(linha, produto.id);

                calcTotalPedido(produto.precoProduto);
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

function criarColunaQtd(elemLinha, idProduto, preco) {
    TOTAL_ANTERIOR = preco;
    let input = document.createElement('input');
    input.setAttribute('type', 'number');
    input.setAttribute('class', 'form-control');
    input.setAttribute('min', '1');
    input.setAttribute('id', QTD_ID+idProduto);
    input.style.width = "60px";
    input.value = 1;

    input.addEventListener("click", function(){
        var quant = document.getElementById(QTD_ID+idProduto).value;
        var total = document.getElementById(TOTAL_ID+idProduto);
        var label = document.querySelector("#total");

        /*
        console.log(preco);
        console.log(quant);
        console.log(preco*quant);
        */

        //Adiciona ou Subtrai o valor Total baseado na Quantidade
        total.value = preco*quant;

        TOTAL_PEDIDO += parseFloat(total.value) - TOTAL_ANTERIOR;
        TOTAL_ANTERIOR = parseFloat(total.value);

        label.textContent = TOTAL_PEDIDO;

    });

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

function criarBotaoRemover(elemLinha, idProduto) {
    let btn = document.createElement('button');
    btn.setAttribute('type', 'button');
    btn.setAttribute('class', 'btn btn-danger');
    btn.innerHTML = 'Remover';

    btn.addEventListener("click", function() { 
        var total = document.getElementById(TOTAL_ID+idProduto).value;

        TOTAL_PEDIDO-=parseFloat(total);
        
        var label = document.querySelector("#total");
        label.textContent = TOTAL_PEDIDO
        
        elemLinha.remove();
    });
    
    var col = elemLinha.insertCell();
    col.appendChild(btn);
}

function calcTotalPedido(preco) {
    TOTAL_PEDIDO+=parseFloat(preco);

    var label = document.querySelector("#total");

    label.textContent = TOTAL_PEDIDO;
}