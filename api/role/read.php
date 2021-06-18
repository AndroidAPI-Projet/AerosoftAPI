<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/role.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Role($db);

    $stmt = $items->getRole();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $RoleArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $resArray = array(
                "IdRole" => $IdRole,
                "RoleNom" => $RoleNom
            );

            array_push($RoleArr, $resArray);
        }
        echo json_encode($RoleArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Aucun role trouvé")
        );
    }
?>