<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/utilisateur.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Utilisateur($db);

    $item->IdUtilisateur = substr($_GET["_url"], -8);
  
    $item->getSingleUtilisateur();

    if($item->Mail != null){
        
        $utilisateur_arr = array(
            "IdUtilisateur" =>  $item->IdUtilisateur,
            "Mail" => $item->Mail,
            "MotDePasse" => $item->MotDePasse,
            "Statut" => $item->Statut,
            "IdRole" => $item->IdRole
        );
      
        http_response_code(200);
        $ArrInti['SingleUtilisateur'] = $utilisateur_arr;

        echo json_encode($ArrInti);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Utilisateur non trouvé");
    }
?>