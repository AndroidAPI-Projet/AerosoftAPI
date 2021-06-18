<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/utilisateur.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Utilisateur($db);

    $stmt = $items->getUtilisateur();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $UtilisateurArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $resArray = array(
                "IdUtilisateur" => $IdUtilisateur,
                "Mail" => $Mail,
                "MotDePasse" => $MotDePasse,
                "Statut" => $Statut,
                "IdRole" => $IdRole
            );

            array_push($UtilisateurArr, $resArray);
        }
        echo json_encode($UtilisateurArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Aucun utilisateur trouvé")
        );
    }
?>