<link rel="stylesheet" type="text/css" href="../view/home/estiloVendedor.css">

<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../../controller/produtoController.php");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<div class="container">
  <!-- Navbar -->
  <div class="row">
    <?php
    require_once(__DIR__ . "/../include/menu2.php");
    ?>
  </div>
</div>

<!-- Estilo de Gradiente Cinza no Canto Esquerdo -->
<style>
  body {
    width: 100%;
    height: 100vh;
    background: linear-gradient(
      to right,
      white 0%,
      white 50%,
      #f8f9fa 50%,
      #f8f9fa 100%
      );
  }
  
</style>

<div class="container">

  <!-- Botão de Vendas -->
  <div id="botoes" class="container d-flex justify-content-left col-md-4" style="position: absolute;top: 55%; left: 20%; font-size:25px">

    <a href="../controller/pedidoController.php?action=listPedVendedor" class="btn btn-outline-success">Pedidos Pendentes</a>

  </div>

  <!-- Botão de Adicionar Produtos -->
  <div class="container d-flex justify-content-left col-md-4" style="position: absolute; top: 65%; left: 20%; font-size:25px">
    <a href="../controller/produtoController.php?action=formProd" class="btn btn-outline-success">Adicionar Produto</a>
  </div>
  
  <!-- Listagem de Produtos -->
  <div class="container d-flex justify-content-left col-md-4" style="position: absolute; top: 25%; left: 50%; font-size:25px;">

    <h2 class="mt-1">Meus Produtos</h2>

    <div class="row mt-5" style="position:absolute;">
      <div class="col">
        <table id="tabUsuarios" class='table table-striped table-bordered'>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Preço</th>
              <th>Categorias</th>
              <th>Detalhes</th>
              <th>Alterar</th>
              <th>Excluir</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($dados['listProd'] as $prod) :
            ?>
              <tr>
                <td><?php echo $prod->getIdProduto(); ?></td>
                <td><?= $prod->getNomeProduto(); ?></td>
                <td><?= $prod->getPrecoProduto(); ?></td>
                <td><?= $prod->getCategoriaDesc(); ?></td>
                <td><?= $prod->getDetalhes(); ?></td>
                <td>
                  <a class="btn btn-success" href="../controller/produtoController.php?action=editProd&id=<?= $prod->getIdProduto() ?>">
                    Alterar
                  </a>
                </td>
                <td>
                  <a class="btn btn-danger" onclick="return confirm('Confirma a exclusão do produto?');" 
                  href="<?= BASEURL ?>/controller/produtoController.php?action=deleteProd&id=<?= $prod->getIdProduto() ?>">
                    Excluir
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<!-- Linha Preta -->
<div style="position: absolute; bottom: 72px; color:black; width:100%; border: 1px solid; right: 0%;"></div>
<?php
require_once(__DIR__ . "/../include/footer.php");
?>