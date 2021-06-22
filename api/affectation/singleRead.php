<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/affectation.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Affectation($db);

    $arr1 = explode("/",$_GET["_url"]);

    $subtStart = substr($arr1[2],0,-4);
    
    $subtMois = substr($arr1[2],-4,2);
    
    $subtJour = substr($arr1[2],-2);
    
    $item->IdAffectation = $subtStart."-".$subtMois."-".$subtJour;
  
    $item->getSingleAffectation();

    if($item->NumVol != null){
        // create array
        $affectation_arr = array(
            "IdAffectation" =>  $item->IdAffectation,
            "NumVol" => $item->NumVol,
            "DateVol" => $item->DateVol,
            "AffectationCode" => $item->AffectationCode,
            "NumAvion" => $item->NumAvion,
            "IdPilote" => $item->IdPilote
        );
      
        http_response_code(200);
      
        $ArrInti['SingleAffectation'] = $affectation_arr;

        echo json_encode($ArrInti);
    }   
    else{
        http_response_code(404);
        echo json_encode("Affectation non trouvé");
    }
?>