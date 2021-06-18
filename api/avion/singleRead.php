<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/avion.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Avion($db);

    $item->NumAvion = substr($_GET["_url"], -3);
  
    $item->getSingleAvion();

    if($item->NumAvion != null){
        // create array
        $avion_arr = array(
            "NumAvion" =>  $item->NumAvion,
            "TypeAvion" => $item->TypeAvion,
            "BaseAeroport" => $item->BaseAeroport
        );
      
        http_response_code(200);
        echo json_encode($avion_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Avion non trouvé");
    }
?>