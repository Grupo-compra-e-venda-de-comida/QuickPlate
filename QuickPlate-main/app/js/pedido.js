var NOME_ID = 'CAMPO_NOME_';
var CATEGORIA_ID = 'CAMPO_CATEGORIA_';
var DETALHES_ID = 'CAMPO_DETALHES_';
var PRECO_ID = 'PRECO_TOTAL_';
var QTD_ID = 'CAMPO_QTD_';
var TOTAL_ID = 'CAMPO_TOTAL_';
var HIDDEN_ID = 'CAMPO_ID_';

var TOTAL_PEDIDO = 0;

function adicionarItem(idProduto) {

    //Criar a requisição
    var url = "pedidoController.php?action=addPed&id=" + idProduto;
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", url, true);

    xhttp.onload = function() {
        var retorno = xhttp.responseText;

        if(retorno[0] == "{") { //Possui retorno JSON = produto encontrado
            //Converte o JSON em objeto JavaScript
            var produto = JSON.parse(retorno);

            //Verificar se o produto já foi adiconar na tabela
            var inputQtdProduto = document.querySelector('#' + QTD_ID + produto.id);
            if(inputQtdProduto) { //Se encontrou, apenas altera a quantidade e o total
                inputQtdProduto.value++; 

                var inputTotalProduto = document.querySelector('#' + TOTAL_ID + produto.id);
                inputTotalProduto.value = inputQtdProduto.value * produto.precoProduto;
                calcTotalPedido();
            
            } else { //Senão, insere um novo produto

                //Caputurado o body da tabela
                var tabela = document.getElementById('tabProdCarrinho');
                var tabelaBodyArray = tabela.getElementsByTagName('tbody');
                var tabelaBody = tabelaBodyArray[0];

                //Criar linha na tabela
                var linha = tabelaBody.insertRow();
                criarColunaNome(linha, produto.id, produto.nomeProduto);
                //criarColunaCat(linha, produto.id, produto.categoriaDesc);
                //criarColunaDet(linha, produto.id, produto.detalhes);
                criarColunaPreco(linha, produto.id, produto.precoProduto);
                criarColunaQtd(linha, produto.id, produto.precoProduto);
                criarColunaTotal(linha, produto.id, produto.precoProduto);
                criarBotaoRemover(linha, produto.id);
                criarColunaId(linha, produto.id);

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

//Funções para criar as colunas
function criarColunaNome(elemLinha, idProduto, nome) {
    let input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('class', 'form-control');
    input.setAttribute('readonly', "");
    input.setAttribute('id', NOME_ID+idProduto);
    input.style.width = "100px";
    input.value = nome;
    
    var col = elemLinha.insertCell();
    col.appendChild(input);
}

function criarColunaCat(elemLinha, idProduto, texto) {
    let input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('class', 'form-control');
    input.setAttribute('readonly', "");
    input.setAttribute('id', CATEGORIA_ID+idProduto);
    input.style.width = "90px";
    input.value = texto;
    
    var col = elemLinha.insertCell();
    col.appendChild(input);
}

function criarColunaDet(elemLinha, idProduto, texto) {
    let input = document.createElement('input');
    input.setAttribute('type', 'text');
    input.setAttribute('class', 'form-control');
    input.setAttribute('readonly', "");
    input.setAttribute('id', DETALHES_ID+idProduto);
    input.style.width = "200px";
    input.value = texto;
    
    var col = elemLinha.insertCell();
    col.appendChild(input);
}

function criarColunaPreco(elemLinha, idProduto, preco) {
    let input = document.createElement('input');
    input.setAttribute('type', 'number');
    input.setAttribute('class', 'form-control');
    input.setAttribute('readonly', "");
    input.setAttribute('id', PRECO_ID+idProduto);
    input.style.width = "90px";
    input.value = preco;
    
    var col = elemLinha.insertCell();
    col.appendChild(input);
}

function criarColunaQtd(elemLinha, idProduto, preco) {
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

        //Adiciona ou Subtrai o valor Total baseado na Quantidade
        total.value = preco*quant;

        calcTotalPedido();

        /*
        var totais = document.querySelectorAll("[id^="+TOTAL_ID+"]");
        var totalCompra = 0;
        totais.forEach((t) => TOTAL_PEDIDO += parseFloat(t.value));

        label.textContent = TOTAL_PEDIDO;
        */

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
        elemLinha.remove();
        calcTotalPedido();
    });
    
    var col = elemLinha.insertCell();
    col.appendChild(btn);
}

function criarColunaId(elemLinha, idProduto) {
    let input = document.createElement('input');
    input.setAttribute('type', 'hidden');
    input.setAttribute('class', 'form-control');
    input.setAttribute('id', HIDDEN_ID+idProduto);
    input.style.width = "1px";
    input.value = idProduto;
    
    var col = elemLinha.insertCell();
    col.appendChild(input);
}

function calcTotalPedido() {
    var totais = document.querySelectorAll("[id^="+TOTAL_ID+"]");
    var totalCompra = 0;
    totais.forEach((t) => totalCompra += parseFloat(t.value));

    //TOTAL_PEDIDO+=parseFloat(preco);

    var label = document.querySelector("#total");
    label.textContent = totalCompra;

    if(totalCompra != 0){
        validarBtn();
    }else {
        invalidarBtn();
    }

    //label.textContent = TOTAL_PEDIDO;
}

function validarBtn() {
    var total = document.getElementById("total");
    var btn = document.getElementById("btnFinalizar");

    btn.removeAttribute("disabled");
}
function invalidarBtn() {
    var btn = document.getElementById("btnFinalizar");

    btn.setAttribute("disabled", "");
}

function finalizarPedido(idVendedor) {

    //Criar a requisição
    var url = "pedidoController.php?action=finishPed&idVendedor="+idVendedor;
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", url);
    xhttp.setRequestHeader('Content-type', 'application/json');

    let itens = [];

    let ids = document.querySelectorAll("[id^='"+HIDDEN_ID+"']");
    let precos = document.querySelectorAll("[id^='"+PRECO_ID+"']");
    let qtds = document.querySelectorAll("[id^='"+QTD_ID+"']");
    let totais = document.querySelectorAll("[id^='"+TOTAL_ID+"']");

    var modal = document.getElementById("modal");

    for(let i=0; i<qtds.length; i++) {

        const item = {idProduto: ids[i].value,
                    valor: precos[i].value, //Valor unitário
                    qtd: qtds[i].value, 
                    total: totais[i].value}; //valor do item
        itens.push(item);
    }

    const json = JSON.stringify(itens);

    xhttp.onload = function() {
        var retorno = xhttp.responseText;
        //console.log(retorno);
    };

    //Enviar a requisição
    xhttp.send(json);
}

function removerTudo() {
    if(! confirm("Confirma a remoção de todos os itens do pedido?"))
        return;

    var tabela = document.getElementById('tabProdCarrinho');
    var tabelaBodyArray = tabela.getElementsByTagName('tbody');
    var tabelaBody = tabelaBodyArray[0];

    tabelaBody.innerHTML = "";

    calcTotalPedido();
}