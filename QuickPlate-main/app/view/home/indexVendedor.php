<?php
require_once(__DIR__ . "/../../controller/produtoController.php");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">


<link href="../css/estiloVendedor.css" rel="stylesheet">
<link href="../css/app.css" rel="stylesheet">
<link href="../css/estiloMenu2.css" rel="stylesheet">
<div class="container-fluid pb-5" style="padding-top: 120px; margin-bottom: 75px;">

  <!-- Navbar -->
  <div class="row">
    <?php
    require_once(__DIR__ . "/../include/menu2.php");
    ?>
  </div>
  <span class="border-bottom"></span>
<!-- Estilo de Gradiente Cinza no Canto Esquerdo -->
<style>
  body {
    width: 100%;
    height: 100vh;
    background:  #f8f9fa;
   
  }
  
</style>

<div class="container-fluid">

  <!-- Listagem de Produtos -->
  <!-- style="position: absolute; top: 20%; left: 42%; font-size:25px;" -->
  <div class="text-lg-start text-muted">

    <div class="page-title">
      <h2><span>Meus Produtos</span></h2>
    </div>
    
    <div class="row mt-5">
      <div class="col">
        <table id="tabUsuarios" class='table table-striped table-bordered' style="text-align: center;">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Preço</th>
              <th>Categorias</th>
              <th>Detalhes</th>
              <th>Alterar</th>
              <th>Inativar</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($dados['listProd'] as $prod) :
            ?>
              <tr>
                <td><?php echo $prod->getIdProduto(); ?></td>
                <td><?= $prod->getNomeProduto(); ?></td>
                <td><?= $prod->getPrecoProdutoFormatado(); ?></td>
                <td><?= $prod->getCategoriaDesc(); ?></td>
                <td><?= $prod->getDetalhes(); ?></td>
                <td>
                  <a class="btn btn-success" href="../controller/produtoController.php?action=editProd&id=<?= $prod->getIdProduto() ?>">
                    Alterar
                  </a>
                </td>
                <td>
                  <a class="btn btn-danger" onclick="return confirm('Confirma a inativação do produto?');" 
                  href="<?= BASEURL ?>/controller/produtoController.php?action=inativarProd&id=<?= $prod->getIdProduto() ?>">
                    Inativar
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

<?php
require_once(__DIR__ . "/../include/footer.php");
?>