<?php 
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
        if (is_object($obj)) {
                $objj = objectToArray($obj);
        foreach ($objj as $key => $value) {
                echo "Nome:{$key}, Quantidade:{$value} </br>";
                print_r($arr);
            }
        }
?>
