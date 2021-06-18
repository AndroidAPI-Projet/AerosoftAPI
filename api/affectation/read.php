<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/affectation.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Affectation($db);

    $stmt = $items->getAffectation();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $AffectationArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $resArray = array(
                "IdAffectation" => $IdAffectation,
                "NumVol" => $NumVol,
                "DateVol" => $DateVol,
                "AffectationCode" => $AffectationCode,
                "NumAvion" => $NumAvion,
                "IdPilote" => $IdPilote
            );

            array_push($AffectationArr, $resArray);
        }
        echo json_encode($AffectationArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Aucun affectation trouvé")
        );
    }
?>