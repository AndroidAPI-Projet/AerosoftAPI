<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/vol.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Vol($db);

    $item->NumVol = substr($_GET["_url"], -5);
  
    $item->getSingleVol();

    if($item->AeroportDept != null){
        // create array
        $vol_arr = array(
            "NumVol" =>  $item->NumVol,
            "AeroportDept" => $item->AeroportDept,
            "HDepart" => $item->HDepart,
            "AeroportArr" => $item->AeroportArr,
            "HArrivee" => $item->HArrivee
        );
      
        http_response_code(200);

        $ArrInti['SingleVol'] = $vol_arr;

        echo json_encode($ArrInti);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Vol non trouvé");
    }
?>