<?php
require_once 'model/model_role.php';
session_start();

if (isset($_GET['modul'])) {
    $modul = $_GET['modul'];
} else {
    $modul = 'dashboard';
}

switch ($modul) {
    case 'dashboard':
        include 'view/kosong.php';
        break;

    case 'role':

        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        $obj_modelRole = new Model_role();

        switch ($fitur) {
            case 'add':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $role_name = $_POST['role_name'];
                    $role_desc = $_POST['role_description'];
                    $role_status = $_POST['role_status'];


                    $obj_modelRole->addRole($role_name, $role_desc, $role_status);


                    header('location: /index.php?modul=role');
                    exit;
                } else {
                    include 'view/role_add.php';
                }
                break;

            case 'edit':
                if (!isset($_GET['id']) || empty($_GET['id'])) {
                    die("ID peran tidak ditemukan.");
                }
                $id = $_GET['id'];
                $role = $obj_modelRole->getRoleById($id);


                if (!$role) {
                    die("Role tidak ditemukan.");
                }

                include 'view/role_update.php';
                break;

            case 'update':
                if (!isset($_GET['id'])) {
                    die("ID peran tidak ditemukan.");
                }


                $idPeran = $_GET['id'];


                $objectRole = new Model_role();

                $role = $objectRole->getRoleById($idPeran);



                if (!$role) {
                    die("Peran tidak ditemukan.");
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $namaPeran = $_POST['role_name'];
                    $descPeran = $_POST['role_description'];
                    $statusPeran = $_POST['role_status'];
                    $objectRole->updateRole($idPeran, $namaPeran, $descPeran, $statusPeran);
            
                    header('Location: index.php?modul=role');
                    exit;
                }
                break;

            case 'delete':
                if (!isset($_GET['id']) || empty($_GET['id'])) {
                    die("ID peran tidak ditemukan.");
                }
                $id = $_GET['id'];


                $cek = $obj_modelRole->getRoleById($id);
                if (!$cek) {
                    die('Role tidak ditemukan!');
                }


                $obj_modelRole->deleteRole($id);


                header('Location: /index.php?modul=role');
                exit;

            default:
                $roles = $obj_modelRole->getAllRoles();
                include 'view/role_list.php';
                break;
        }
        break;

    default:
        include 'view/kosong.php';
        break;
}