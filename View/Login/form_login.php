<?php
    include VIEW . "/Includes/header.php";
    include VIEW . "/Includes/navbar.php";
?>

<div class="p-5 center">
    <h1> Login </h1>
</div>

<form method="POST" action="/infotech/login">
 
  <div class="mb-3">
    <label for="email" class="form-label">E-mail</label>
    <input type="email" class="form-control" id="email" name="email" value="<?= $model->email ?? '' ?>" >
  </div>

  <div class="mb-3">
    <label for="senha" class="form-label">Senha</label>
    <input type="password" class="form-control" id="senha" name="senha" >
  </div>

  <button type="submit" name="login" id="login" class="btn btn-primary"> Logar </button>
</form>

<?php
   include VIEW . "/Includes/footer.php";
?>