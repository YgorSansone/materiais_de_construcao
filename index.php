<?PHP
require_once("config/conexaodb.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
<div class="container-fluid">
    <!-- <input id="csv" type="file"> -->
    <!-- <input type="file" id="csv" accept=".csv"> -->
    <div class="jumbotron">
  <h1 class="display-4">Lista de Materiais de construção</h1>
  <p class="lead">Coloque a sua lista de compras e veja em qual loja terá o melhor preço</p>
  <hr class="my-4">
  <p>Somente arquivos .csv</p>
  <p class="lead">
    <!-- <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> -->
    <div class="d-flex justify-content-center">
    <div class="col-lg-6 col-sm-6 col-12">
    <div class="custom-file">
    <input type="file" class="custom-file-input" id="csv" accept=".csv"lang="pt-br" required>
    <label class="custom-file-label" for="customFileLang">Escolha um arquivo .csv</label>
    </div>
    </div>
  </div>
  </p>
</div>

    <div class="resultado" id="resultado"></div>
    <!-- <output id="out">
        file contents will appear here
    </output> -->
</div>

    <script src="js/opencsv.js"></script>
</body>

</html>