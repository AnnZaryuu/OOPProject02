<?php
require_once("Model\model_role.php");
session_start();

if (isset($_GET['modul'])) {
    $modul = $_GET['modul'];
} else {
    $modul = 'dashboard';
}

if (isset($_GET['fitur'])) {
    $fitur = $_GET['fitur'];
} else {
    $fitur = '';
}

switch ($modul) {
    case 'dashboard':
        include 'view\kosong.php';
        break;
        
    case 'role':
        $obj_modelRole = new Model_role();  
        $roles = $obj_modelRole->GetAllRoles();
        
        switch ($fitur) {
            case 'add':
                $role_name = $_POST['role_name'];
                $role_deskripsi = $_POST['role_description'];
                $role_status = $_POST['role_status'];

                $obj_modelRole->AddRole($role_name, $role_deskripsi, $role_status);


                header('Location: /index.php?modul=role');
                break;
            default:
                $role = $obj_modelRole->GetAllRoles();
                include 'view\role_list.php';
        }
        
        break;
}
