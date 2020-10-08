<?php 
require_once("../config/conexaodb.php");
    function objectToArray($d) {
        if (is_object($d)) {
            $d = get_object_vars($d);
        }
		
        if (is_array($d)) {
            return array_map(__FUNCTION__, $d);
        }
        else {
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
        foreach ($objj as $key => $value) {
                echo "Nome:{$key}, Quantidade:{$value} </br>";
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
                print_r($arr);
            }
        }
        // print_r($quantidade);
        print_r(sizeof($list_id).'</br>');
        $id_materiais= substr($x, 0, -1);
        $size = sizeof($list_id);
        print_r($x);
        $idDeposito = "";

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
          echo '<br>' . $user['deposito'] . $user['precoTotal'] .$user['idDeposito'] ;
          $idDeposito .= $user['idDeposito'] . ',';
        }
        $idDeposito = substr($idDeposito, 0, -1);
        $quero_preco = "SELECT (SELECT nome from material WHERE id = codMaterial) as material,
         preco, (SELECT nome from deposito WHERE id = codDeposito) as deposito
          from estoque where codDeposito IN ($idDeposito)
           AND codMaterial IN ($id_materiais)"; 
        $query_preco = $_con->prepare($quero_preco);
        $query_preco->execute();
        $resultado_query_preco = $query_preco->fetchAll();

        foreach ($resultado_query_preco as $resultado) {
            echo "<h2>".$resultado['deposito']."</h2>";
            echo "<br><strong>".$resultado['material'].": ".$resultado['preco']."</strong>";
        }
       
?>
