<?PHP
try {
  $_con = new PDO("mysql:host=sql10.freesqldatabase.com;dbname=sql10369355;charset=utf8", "sql10369355", "fsr5U5FKKS", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  $_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  // while ($linha = $SELECT->fetch(PDO::FETCH_ASSOC)) {
  //   echo "{$linha['nome']}</br>";
  // }
} catch (PDOException $e) {
  echo 'ERROR: ' . $e->getMessage();
}
