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
  
  <button type="submit" name="salvar" id="salvar" class="btn btn-primary">Salvar</button>
</form>

<?php
   include VIEW . "/Includes/footer.php";
?>