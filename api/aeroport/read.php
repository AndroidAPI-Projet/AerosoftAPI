<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/aeroport.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Aeroport($db);

    $stmt = $items->getAeroport();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $AeroportArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $resArray = array(
                "IdAeroport" =>  $IdAeroport,
                "NomAeroport" => $NomAeroport,
                "NomVilleDesservie" => $NomVilleDesservie
            );

            array_push($AeroportArr, $resArray);
        }
        echo json_encode($AeroportArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Aucun aeroport trouvé")
        );
    }
?>