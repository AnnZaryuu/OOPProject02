<?php
// Mengaktifkan error reporting untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'model/model_role.php';
require_once 'model/model_barang.php';

session_start();

// Mendapatkan modul yang dipilih dari URL atau default ke 'dashboard'
$modul = isset($_GET['modul']) ? $_GET['modul'] : 'dashboard';

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

                    // Menambahkan role baru
                    $obj_modelRole->addRole($role_name, $role_desc, $role_status);
                    header('Location: index.php?modul=role');
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
                $role = $obj_modelRole->getRoleById($idPeran);

                if (!$role) {
                    die("Peran tidak ditemukan.");
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $namaPeran = $_POST['role_name'];
                    $descPeran = $_POST['role_description'];
                    $statusPeran = $_POST['role_status'];
                    $obj_modelRole->updateRole($idPeran, $namaPeran, $descPeran, $statusPeran);

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

                header('Location: index.php?modul=role');
                exit;

            default:
                $roles = $obj_modelRole->getAllRoles();
                include 'view/role_list.php';
                break;
        }
        break;

    case 'barang':
        // Instansiasi model barang
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        $obj_modelBarang = new Model_barang();

        switch ($fitur) {
            case 'add':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $barang_name = $_POST['barang_name'];
                    $barang_jenis = $_POST['barang_jenis'];
                    $barang_harga = $_POST['barang_harga'];

                    // Menambahkan barang baru
                    $obj_modelBarang->AddBarang($barang_name, $barang_jenis, $barang_harga);
                    header('Location: index.php?modul=barang');
                    exit;
                } else {
                    include 'view/barang_input.php';
                }
                break;

            case 'edit':
                if (!isset($_GET['id']) || empty($_GET['id'])) {
                    die("ID barang tidak ditemukan.");
                }
                $id = $_GET['id'];
                $barang = $obj_modelBarang->GetBarangById($id);

                if (!$barang) {
                    die("Barang tidak ditemukan.");
                }

                include 'view\update_barang.php';
                break;

            case 'update':
                if (!isset($_GET['id'])) {
                    die("ID barang tidak ditemukan.");
                }

                $idBarang = $_GET['id'];
                $barang = $obj_modelBarang->GetBarangById($idBarang);

                if (!$barang) {
                    die("Barang tidak ditemukan.");
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $namaBarang = $_POST['barang_name'];
                    $jenisBarang = $_POST['barang_jenis'];
                    $hargaBarang = $_POST['barang_harga'];
                    $obj_modelBarang->UpdateBarang($idBarang, $namaBarang, $jenisBarang, $hargaBarang);

                    header('Location: index.php?modul=barang');
                    exit;
                }
                break;

            case 'delete':
                if (!isset($_GET['id']) || empty($_GET['id'])) {
                    die("ID barang tidak ditemukan.");
                }
                $id = $_GET['id'];

                $cek = $obj_modelBarang->GetBarangById($id);
                if (!$cek) {
                    die('Barang tidak ditemukan!');
                }

                $obj_modelBarang->DeleteBarang($id);

                header('Location: index.php?modul=barang');
                exit;

            default:
                $barangs = $obj_modelBarang->GetAllBarangs();
                include 'view/barang_list.php';
                break;
        }
        break;

    default:
        include 'view/kosong.php';
        break;
}
?>
