<?php
    include VIEW . "/Includes/header.php";
    include VIEW . "/Includes/navbar.php";
?>

<div class="p-5 center">
    <h1> Cadastrar Clientes </h1>
</div>

<form method="POST" action="/infotech/cliente/cadastro">
  <div class="mb-3">
    <input type="hidden" name="id_cliente" id="id_cliente" value="<?= $model->id_cliente ?? '' ?>" >
    <label for="nome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" value="<?= $model->nome ?? '' ?>" >
  </div>
  <div class="mb-3">
    <label for="telefone" class="form-label">Fone</label>
    <input type="text" class="form-control" id="telefone" name="telefone" value="<?= $model->telefone ?? '' ?>" >
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">E-mail</label>
    <input type="email" class="form-control" id="email" name="email" value="<?= $model->email ?? '' ?>" >
  </div>

  <div class="mb-3">
            <select class="form-select" name="status_cliente" id="status_cliente">
                <option selected>Selecione o Status</option>
                <option value="ATIVO"> Ativo </option>
                <option value="INATIVO"> Inativo </option>
            </select>
  </div>

  

  <div class="mb-3">
    <label for="id_categoria" class="form-label">Categoria</label>
    <div class="input-group">
      <!-- as opções são carregadas pelo categoria.js; data-selecionado guarda a categoria atual na edição -->
      <select class="form-select" name="id_categoria" id="id_categoria" required
              data-selecionado="<?= $model->id_categoria ?? '' ?>">
        <option value="" disabled selected>Carregando categorias...</option>
      </select>
      <button type="button" class="btn btn-outline-secondary" id="btn_nova_categoria">
        <i class="bi bi-plus-lg"></i> Categoria
      </button>
    </div>
  </div>
  
  <button type="submit" name="salvar" id="salvar" class="btn btn-primary">Salvar</button>
</form>

<script src="../View/Includes/js/categoria.js" defer></script>
<script src="../View/Includes/js/cadastro_cliente.js" defer></script>

<?php
   include VIEW . "/Includes/modais/modal_categoria.php";
   include VIEW . "/Includes/footer.php";
?>