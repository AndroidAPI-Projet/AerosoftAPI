<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/pilote.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Pilote($db);

    $stmt = $items->getPilote();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $PiloteArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $resArray = array(
                "IdPilote" => $IdPilote,
                "NomPilote" => $NomPilote,
                "PrenomPilote" => $PrenomPilote,
                "Matricule" => $Matricule
            );

            array_push($PiloteArr, $resArray);
        }
        echo json_encode($PiloteArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Aucun pilote trouvé")
        );
    }
?>