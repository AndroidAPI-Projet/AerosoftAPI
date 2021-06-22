<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/pilote.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Pilote($db);

    $item->IdPilote = substr($_GET["_url"], -1);
  
    $item->getSinglePilote();

    if($item->IdPilote != null){
        // create array
        $pilote_arr = array(
            "IdPilote" =>  $item->IdPilote,
            "NomPilote" => $item->NomPilote,
            "PrenomPilote" => $item->PrenomPilote,
            "Matricule" => $item->Matricule
        );
      
        http_response_code(200);
        $ArrInti['SinglePilote'] = $pilote_arr;

        echo json_encode($ArrInti);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Pilote non trouvé");
    }
?>