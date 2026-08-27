<?php
    include VIEW . "/Includes/header.php";
    include VIEW . "/Includes/navbar.php";
?>

<div class="p-5 center">
    <h1> Clientes Cadastrados </h1>
</div>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nome</th>
      <th scope="col">Telefone</th>
      <th scope="col">E-mail</th>
      <th scope="col">Status</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody>
   <?php
    // print_r($model);
        foreach($model->rows as $cliente):
            echo ' <tr>
                        <th scope="row"> '.$cliente->id_cliente.'  </th>
                        <td> '.$cliente->nome.'  </td>
                        <td> '.$cliente->telefone.'  </td>
                        <td>  '.$cliente->email.'  </td>
                        <td>  '.$cliente->status_cliente.'  </td>
                        <td> 
                            <a class="btn btn-dark" href="/infotech/cliente/cadastro?id_cliente='.$cliente->id_cliente.'"> <i class="bi bi-pencil-square"></i>  </a>
                            <a class="btn btn-danger" href="/infotech/cliente/exclusao?id_cliente='.$cliente->id_cliente.'"> <i class="bi bi-trash-fill"></i> </a>
                        </td>
                    </tr>';
        endforeach;
   ?>
  </tbody>
</table>

<?php
   include VIEW . "/Includes/footer.php";
?>