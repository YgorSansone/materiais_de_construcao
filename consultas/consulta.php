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
        $quantidade = array();
        if (is_object($obj)) {
                $objj = objectToArray($obj);
        foreach ($objj as $key => $value) {
                echo "Nome:{$key}, Quantidade:{$value} </br>";
                array_push($materiais, $key);
                array_push($quantidade, $value);
                $SELECT = $_con->prepare("SELECT * FROM deposito WHERE id IN (SELECT codDeposito FROM estoque where codMaterial IN (SELECT id from material WHERE nome = '$key'))");
                // SELECT * FROM table1 WHERE id IN (SELECT id FROM table2);
                print_r($arr);
            }
        }
        // print_r($materiais);
        // print_r($quantidade);

        
        // var_dump($SELECT);
        // print_r($SELECT);
        // $getUsers = $DBH->prepare("SELECT * FROM users ORDER BY id ASC");
        $SELECT->execute();
        $users = $SELECT->fetchAll();
        foreach ($users as $user) {
          echo '<br>' . $user['nome'];
        }
?>
