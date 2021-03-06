<?php
require_once('./list_usuario.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--CSS only-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <link rel="stylesheet" type="text/css" href="../css/estilo.css"/>
  <link rel="stylesheet" type="text/css" href="../css/login.css"/>
  <link rel="stylesheet" type="text/css" href="../css/cadastro.css"/>
  <link rel="stylesheet" type="text/css" href="../css/access.css"/>
  <title>Área do Cliente - Dev Hair Studio</title>
</head>

<body>
  <header class="container-fluid">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="../index.html"><img src="../img/logo.png" class="img-responsive" width="130" height="130" /></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="../index.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="../espaco.html">Nosso Espaço</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="produtos.html">Produtos</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div><!--Fim Navbar-->
  </header><!--Fim Cabeçalho-->
  <div class="container">
    <h1 id="titulo">Bem-Vinda(o) ao Dev Hair Style!</h1>
    <table class="table table-stripped">
      <thead id="tabela">
        <th>#</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>CPF</th>
        <th>Telefone</th>
        <th>Data de Cadastro</th>
        <th>Editar</th>
      </thead>
      <tbody>
        <?php foreach ($result as $row) { ?>
          <tr id="dados">
            <td><?= $row['idLogin'] ?></td>
            <td><?= $row['Nome'] ?></td>
            <td><?= $row['Email'] ?></td>
            <td><?= $row['CPF'] ?></td>
            <td><?= $row['Telefone'] ?></td>
            <td><?=
                date('d/m/y', strtotime($row['DataCadastro']))
                ?></td>
            <td>
              <a href="cliente_form_edit.php?idLogin=<?= $row['idLogin'] ?>"><span style="color: green;"><i class="fa-solid fa-pen-to-square"></i></span></a>
              <a href="cliente_delete.php?idLogin=<?= $row['idLogin'] ?>" onclick="return confirm('Deseja realmente remover o cliente <?= $row['Nome'] ?> ?')"><span style="color: red;"><i class="fa-solid fa-eraser"></i></span></a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div><!--Fim Container-->
  <footer class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col pt-4">
          <h5 class="text-light">Mapa do Site</h5>
          <nav id="menufinal">
            <ul>
              <li><a href="index.html">Home</a></li>
              <li><a href="espaco.html">Nosso Espaço</a></li>
              <li><a href="produtos.html">Produtos</a></li>
            </ul>
          </nav>
        </div><!--Fim Mapa do Site-->
        <div class="col pt-4">
          <h5 class="text-light">Rede Sociais</h5>
          <div class="columns">
            <a href="#" target="_blank"><img src="../img/face.png" width="40" height="40" /></a>
            <a href="#" target="_blank"><img src="../img/insta.png" width="40" height="40" class="ps-1" /></a>
            <a href="#" target="_blank"><img src="../img/zap.png" width="40" height="40" class="ps-1" /></a>
          </div><!--Fim Columns-->
        </div><!--Fim Rede Sociais-->
        <div class="col pt-4">
          <h5 class="text-light">Contato</h5>
          <p class="text-light">Av. João Cabral de Mello Netto, nº 850, Barra da Tijuca, Rio de Janeiro - RJ, 22.275-055 <br> contato@devhairstudio.com <br> Tel. (21) 2222-2222 / (21) 99999-9999</p>
        </div>
        <div class="col pt-4">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3673.0464624047213!2d-43.360713585271704!3d-22.98531888497192!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9bdb55e71a0bdf%3A0xe47698cf9d7e9219!2sEspa%C3%A7o%20VS%20hair%20%26%20CO!5e0!3m2!1spt-BR!2sbr!4v1646264878773!5m2!1spt-BR!2sbr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div><!--Fim Mapa-->
        <div class="col-12 pt-3 pb-3 text-center text-light">
          &copy; Todos os direitos reservados 2022.
        </div><!--Fim Col-12-->
      </div><!--Fim Row-->
    </div><!--Fim Container-->
  </footer><!--Fim Footer-->
</body>

</html>