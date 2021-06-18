<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/avion.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Avion($db);

    $stmt = $items->getAvion();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $AvionArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $resArray = array(
                "NumAvion" => $NumAvion,
                "TypeAvion" => $TypeAvion,
                "BaseAeroport" => $BaseAeroport
            );

            array_push($AvionArr, $resArray);
        }
        echo json_encode($AvionArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Aucun avion trouvé")
        );
    }
?>