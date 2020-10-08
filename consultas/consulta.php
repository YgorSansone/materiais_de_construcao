<?php
require_once("../config/conexaodb.php");
//Converte objeto em array
function objectToArray($d)
{
    if (is_object($d)) {
        $d = get_object_vars($d);
    }

    if (is_array($d)) {
        return array_map(__FUNCTION__, $d);
    } else {
        return $d;
    }
}

$obj = json_decode($_POST['val']);
$materiais = array();
$list_id = array();
$x = "";
$quantidade = array();
if (is_object($obj)) {
    $objj = objectToArray($obj);
    $y = 0;

    //acha todos os materiais no banco
    foreach ($objj as $key => $value) {
        // echo "Nome:{$key}, Quantidade:{$value} </br>";
        array_push($materiais, $key);
        array_push($quantidade, $value);
        // $SELECT = $_con->prepare("SELECT * FROM deposito WHERE id IN (SELECT codDeposito FROM estoque where codMaterial IN (SELECT id from material WHERE nome = '$key'))ORDER BY nome DESC");
        $query_id = "SELECT id from material WHERE nome = '$key'";
        $SELECT_ID_MATERIAL = $_con->prepare($query_id);
        $SELECT_ID_MATERIAL->execute();
        $ids = $SELECT_ID_MATERIAL->fetchAll();
        foreach ($ids as $id) {
            array_push($list_id, $id['id']);
            $x .= $id['id'] . ',';
        }
        // print_r("</br>".$value." <=> " . $key);
        $tabela3 =  '<table class="table table-striped table-dark">';
        $tabela3 .= '<thead>';
        $tabela3 .= ' <tr>';
        $tabela3 .= '<th scope="col">#</th>';
        $tabela3 .= ' <th scope="col">Nome</th>';
        $tabela3 .= ' <th scope="col">Quantidade</th>';
        $tabela3 .= '</tr>';
        $tabela3 .= '</thead>';
        $tabela3 .= '<tbody>';
        $tabelabody3 .= '  <tr>';
        $tabelabody3 .= '    <th scope="row">' . $y . '</th>';
        $tabelabody3 .= '    <td>' . $key . '</td>';
        $tabelabody3 .= '    <td>' . $value . '</td>';
        $tabelabody3 .= '  </tr>';
        $tabelafinal3 .= '</tbody>';
        $tabelafinal3 .= '</table>';
        $y++;
        // print_r($arr);
    }
}
$id_materiais = substr($x, 0, -1);
$size = sizeof($list_id) - 1;
$idDeposito = "";

//Busca a menor soma dos preços dos produtos ordenando do menor para o maior
$query = "SELECT d.nome as deposito, d.id as idDeposito, SUM(preco) as precoTotal 
                FROM estoque e
                JOIN deposito d ON d.id=e.codDeposito
                JOIN material m ON m.id=e.codMaterial
                WHERE codMaterial IN ('$id_materiais')
                GROUP BY codDeposito
                HAVING COUNT(codMaterial) <= '$size'
                ORDER BY SUM(preco) ASC";


$SELECT = $_con->prepare($query);
$SELECT->execute();
$users = $SELECT->fetchAll();

foreach ($users as $user) {
    //   echo '<br>' . $user['deposito'] . $user['precoTotal'] .$user['idDeposito'] ;
    $idDeposito .= $user['idDeposito'] . ',';
}

$idDeposito = substr($idDeposito, 0, -1);
//busca todos produtos da lista com os seus dados
$quero_preco = "SELECT (SELECT nome from material WHERE id = codMaterial) as material,
        (SELECT id from material WHERE nome = material) as idmaterial,
         preco, (SELECT nome from deposito WHERE id = codDeposito) as deposito,
         (SELECT id from deposito WHERE id = codDeposito) as iddeposito
          from estoque where codDeposito IN ($idDeposito)
           AND codMaterial IN ($id_materiais)";
$query_preco = $_con->prepare($quero_preco);
$query_preco->execute();
$resultado_query_preco = $query_preco->fetchAll();
$list_preco_loja = array();
//Multiplica os produtos pelo id para ter o preço final
foreach ($resultado_query_preco as $resultado => $index) {

    $chave = array_search($index['idmaterial'], $list_id);
    $preco_quantidade = $index['preco'] * $quantidade[$chave];
    // echo "</br>". $index['preco'] ." * ". $quantidade[$chave] . " = ".  $preco_quantidade . "</br>";

    $chave = array_search($index['idmaterial'], $list_id);

    $preco_final[$index['deposito']] += $preco_quantidade;

    // echo "<h2>".$index['deposito']."</h2>";
    // echo "<br><strong>".$index['material'].": ".$index['preco']. " -> ".$index['idmaterial'] ."</strong>";
    $tabela =  '<table class="table table-striped table-dark">';
    $tabela .= '<thead>';
    $tabela .= ' <tr>';
    $tabela .= '<th scope="col">#</th>';
    $tabela .= ' <th scope="col">Deposito</th>';
    $tabela .= ' <th scope="col">Nome</th>';
    $tabela .= '  <th scope="col">preço unitario</th>';
    $tabela .= ' <th scope="col">Preço multiplicado</th>';
    $tabela .= '</tr>';
    $tabela .= '</thead>';
    $tabela .= '<tbody>';
    $tabelabody .= '  <tr>';
    $tabelabody .= '    <th scope="row">' . $resultado . '</th>';
    $tabelabody .= '    <td>' . $index['deposito'] . '</td>';
    $tabelabody .= '    <td>' . $index['material'] . '</td>';
    $tabelabody .= '    <td>' . $index['preco'] . '</td>';
    $tabelabody .= '    <td>' . $preco_quantidade . '</td>';
    $tabelabody .= '  </tr>';
    $tabelafinal .= '</tbody>';
    $tabelafinal .= '</table>';
}
$z = 0;
foreach ($preco_final as $key => $value) {
    // print_r("</br>".$value." <=> " . $key);
    $tabela2 =  '<table class="table table-striped table-dark">';
    $tabela2 .= '<thead>';
    $tabela2 .= ' <tr>';
    $tabela2 .= '<th scope="col">#</th>';
    $tabela2 .= ' <th scope="col">Deposito</th>';
    $tabela2 .= ' <th scope="col">Preço total</th>';
    $tabela2 .= '</tr>';
    $tabela2 .= '</thead>';
    $tabela2 .= '<tbody>';
    $tabelabody2 .= '  <tr>';
    $tabelabody2 .= '    <th scope="row">' . $z . '</th>';
    $tabelabody2 .= '    <td>' . $key . '</td>';
    $tabelabody2 .= '    <td>' . $value . '</td>';
    $tabelabody2 .= '  </tr>';
    $tabelafinal2 .= '</tbody>';
    $tabelafinal2 .= '</table>';
    $z++;
}

//printa as tabelas
echo "<h1>Tabela para orçamento</h1>";
echo $tabela3 . $tabelabody3 . $tabelafinal3;
echo "<br>";
echo "<h1>Melhor preço e com o maximo de produto da lista</h1>";
echo $tabela2 . $tabelabody2 . $tabelafinal2;
echo "<br>";
echo "<h1>Tabela de preço</h1>";
echo $tabela . $tabelabody . $tabelafinal;
echo "<br>";
?>
