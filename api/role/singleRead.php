<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/role.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Role($db);

    $item->IdRole = substr($_GET["_url"], -5);
  
    $item->getSingleRole();

    if($item->IdRole != null){
        // create array
        $role_arr = array(
            "IdRole" =>  $item->IdRole,
            "RoleNom" => $item->RoleNom
        );
      
        http_response_code(200);
        echo json_encode($role_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Role non trouvé");
    }
?>