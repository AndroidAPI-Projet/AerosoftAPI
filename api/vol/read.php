<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/vol.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Vol($db);

    $stmt = $items->getVol();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $VolArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $resArray = array(
                "NumVol" => $NumVol,
                "AeroportDept" => $AeroportDept,
                "HDepart" => $HDepart,
                "AeroportArr" => $AeroportArr,
                "HArrivee" => $HArrivee
            );

            array_push($VolArr, $resArray);
        }
        echo json_encode($VolArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Aucun vol trouvé")
        );
    }
?>