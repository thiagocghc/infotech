<?php
    include VIEW . "/Includes/header.php";
    include VIEW . "/Includes/navbar.php";
?>

<div class="p-5 center">
    <h1> Cadastrar Clientes </h1>
</div>

<form method="POST" action="/infotech/cliente/cadastro" id="form_cliente">
  <input type="hidden" name="id_cliente" id="id_cliente" value="<?= $model->id_cliente ?? '' ?>">

  <div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" required
           value="<?= htmlspecialchars($model->nome ?? '') ?>">
  </div>

  <div class="mb-3">
    <label for="telefone" class="form-label">Fone</label>
    <input type="text" class="form-control" id="telefone" name="telefone"
           value="<?= htmlspecialchars($model->telefone ?? '') ?>">
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">E-mail</label>
    <input type="email" class="form-control" id="email" name="email"
           value="<?= htmlspecialchars($model->email ?? '') ?>">
  </div>

  <div class="mb-3">
    <label for="status_cliente" class="form-label">Status</label>
    <select class="form-select" name="status_cliente" id="status_cliente" required>
      <option value="" disabled <?= empty($model->status_cliente) ? 'selected' : '' ?>>Selecione o status</option>
      <option value="ATIVO"   <?= ($model->status_cliente ?? '') === 'ATIVO'   ? 'selected' : '' ?>>Ativo</option>
      <option value="INATIVO" <?= ($model->status_cliente ?? '') === 'INATIVO' ? 'selected' : '' ?>>Inativo</option>
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

  <button type="submit" name="salvar" id="salvar" class="btn btn-primary">Salvar cliente</button>
</form>

<?php
   include VIEW . "/Includes/modais/modal_categoria.php";
?>

<script src="<?= URL_BASE ?>/View/Includes/js/categoria.js" defer></script>
<script src="<?= URL_BASE ?>/View/Includes/js/cadastro_cliente.js" defer></script>

<?php
   include VIEW . "/Includes/footer.php";
?>