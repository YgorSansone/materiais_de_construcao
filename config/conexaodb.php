<?PHP
try {
  $_con = new PDO("mysql:host=sql10.freesqldatabase.com;dbname=sql10369355;charset=utf8", "sql10369355", "fsr5U5FKKS", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  $_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $SELECT = $_con->prepare("SELECT * from material");
  // var_dump($SELECT);
  // print_r($SELECT);
  // $getUsers = $DBH->prepare("SELECT * FROM users ORDER BY id ASC");
  $SELECT->execute();
  $users = $SELECT->fetchAll();
  foreach ($users as $user) {
    echo '<br>' . $user['nome'];
  }

  // while ($linha = $SELECT->fetch(PDO::FETCH_ASSOC)) {
  //   echo "{$linha['nome']}</br>";
  // }
} catch (PDOException $e) {
  echo 'ERROR: ' . $e->getMessage();
}
