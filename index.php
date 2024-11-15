<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'model/model_role.php';
require_once 'model/model_barang.php';
require_once 'model/model_User.php';
require_once 'model/model_transaksi.php';

session_start();

if (!isset($_SESSION['user_id']) && (!isset($_GET['modul']) || $_GET['modul'] != 'login')) {
    header('Location: index.php?modul=login');
    exit;
}

if (isset($_GET['modul'])) {
    $modul = $_GET['modul'];
} else {
    $modul = 'dashboard';
}

switch ($modul) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['user_username'];
            $password = $_POST['user_password'];

            $modelRole = new Model_role();
            $obj_modelUser = new ModelUser($modelRole);

            $user = $obj_modelUser->getUserByUsername($username);


            if ($user && password_verify($password, $user->user_password)) {
                $_SESSION['user_id'] = $user->user_id;
                $_SESSION['username'] = $user->user_username;
                $_SESSION['role'] = $user->role;

                header('Location: index.php?modul=dashboard');
                exit;
            } else {
                $error = "Username atau password salah!";
            }
        }
        include 'view\loginpage.php';
        break;

    case 'logout':
        // Hapus semua session
        session_start();
        session_unset(); // Menghapus semua variabel session
        session_destroy();
    
        header('Location: index.php?modul=login');
       break;
    

    case 'dashboard':
        include 'view/landingPage.php';
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
                    header('Location: index.php?modul=role');
                    exit;
                } else {
                    include 'view/role_add.php';
                }
                break;

            case 'edit':
                $id = $_GET['id'] ?? null;
                if (!$id) {
                    die("ID peran tidak ditemukan.");
                }
                $role = $obj_modelRole->getRoleById($id);
                if (!$role) {
                    die("Role tidak ditemukan.");
                }
                include 'view/role_update.php';
                break;

            case 'update':
                $idPeran = $_GET['id'] ?? null;
                if (!$idPeran) {
                    die("ID peran tidak ditemukan.");
                }
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
                $id = $_GET['id'] ?? null;
                if (!$id) {
                    die("ID peran tidak ditemukan.");
                }
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
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        $obj_modelBarang = new Model_barang();

        switch ($fitur) {
            case 'add':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $barang_name = $_POST['barang_name'];
                    $barang_jenis = $_POST['barang_jenis'];
                    $barang_harga = $_POST['barang_harga'];
                    $obj_modelBarang->AddBarang($barang_name, $barang_jenis, $barang_harga);
                    header('Location: index.php?modul=barang');
                    exit;
                } else {
                    include 'view/barang_input.php';
                }
                break;

            case 'edit':
                $id = $_GET['id'] ?? null;
                if (!$id) {
                    die("ID barang tidak ditemukan.");
                }
                $barang = $obj_modelBarang->GetBarangById($id);
                if (!$barang) {
                    die("Barang tidak ditemukan.");
                }
                include 'view/update_barang.php';
                break;

            case 'update':
                $idBarang = $_GET['id'] ?? null;
                if (!$idBarang) {
                    die("ID barang tidak ditemukan.");
                }
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
                $id = $_GET['id'] ?? null;
                if (!$id) {
                    die("ID barang tidak ditemukan.");
                }
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

    case 'user':
        $fitur = $_GET['fitur'] ?? null;
        $obj_modelRole = new Model_role();
        $obj_modelUser = new ModelUser($obj_modelRole);


        switch ($fitur) {
            case 'add':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $user_nama = $_POST['user_nama'];
                    $user_username = $_POST['user_username'];
                    $user_password = $_POST['user_password'];
                    $user_role_id = $_POST['user_role_id'];

                    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);

                    $obj_modelUser->addUser($user_nama, $user_username, $hash_password, $user_role_id);
                    header('Location: index.php?modul=user');
                    exit;
                } else {
                    include 'view/user_input.php';
                }
                break;

            case 'update':
                if (!isset($_GET['id'])) {
                    die("ID user tidak ditemukan");
                }
                $user_id = $_GET['id'];
                $user = $obj_modelUser->getUserById($user_id);
                if (!$user) {
                    die("User Tidak Dapat Ditemukan");
                }
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $user_nama = $_POST['user_nama'];
                    $user_username = $_POST['user_username'];
                    $user_password = $_POST['user_password'];
                    $user_role_id = $_POST['user_role_id'];

                    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
                    $obj_modelUser->updateUser($user_id, $user_nama, $user_username, $hash_password, $user_role_id);
                    header('Location: index.php?modul=user');
                    exit;
                }

                break;

            case 'edit':
                if (!isset($_GET['id']) || empty($_GET['id'])) {
                    die("ID user tidak ditemukan");
                }
                $user_id = $_GET['id'];
                $user = $obj_modelUser->getUserById($user_id);
                if (!$user) {
                    die("User Tidak Dapat Ditemukan");
                }
                include 'view/user_update.php';
                break;

            case 'delete':
                if (!isset($_GET['id']) || empty($_GET['id'])) {
                    die("ID user tidak ditemukan");
                }
                $user_id = $_GET['id'];
                $cek = $obj_modelUser->getUserById($user_id);
                if (!$cek) {
                    die("ID user tidak ditemukan");
                }
                $obj_modelUser->deleteUser($user_id);
                header('Location: index.php?modul=user');
                exit;

            default:
                $users = $obj_modelUser->getAllUser();
                include 'view/user_list.php';
                break;
        }
        break;
    case 'transaksi':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        $modelRole = new Model_role();
        $modelUser = new ModelUser($modelRole);
        $modelBarang = new Model_barang();
        $modelTransaksi = new ModelTransaksi($modelUser, $modelRole, $modelBarang);

        switch ($fitur) {
            case 'add':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['customer'], $_POST['kasir'], $_POST['barang'], $_POST['jumlah'])) {
                        $customer_id = $_POST['customer'];
                        $kasir_id = $_POST['kasir'];
                        $barang_ids = $_POST['barang'];
                        $jumlahs = $_POST['jumlah'];

                        $customer = $modelUser->getUserById($customer_id);
                        $kasir = $modelUser->getUserById($kasir_id);

                        $barangs = [];
                        foreach ($barang_ids as $barang_id) {
                            $barangs[] = $modelBarang->getBarangById($barang_id);
                        }

                        $total = 0;
                        foreach ($barangs as $key => $barang) {
                            $total += $barang->barang_harga * $jumlahs[$key];
                        }

                        $tgl_transaksi = date('d-m-Y');

                        $modelTransaksi->addTransaksi($tgl_transaksi, $customer, $kasir, $total, $barangs, $jumlahs);

                        header('Location: index.php?modul=transaksi');
                        exit;
                    } else {
                        die("Data tidak lengkap.");
                    }
                } else {
                    $customers = $modelUser->getUserByRole('Customer');
                    $kasirs = $modelUser->getUserByRole('Kasir');
                    $barangs = $modelBarang->getAllBarangs();

                    include 'view/transaksi_input.php';
                }
                break;

                // case 'update':
                //     if (!isset($_GET['id'])) {
                //         die("ID transaksi tidak ditemukan");
                //     }
                //     $transaksi_id = $_GET['id'];
                //     $transaksi = $modelTransaksi->getTransaksiById($transaksi_id);
                //     if (!$transaksi) {
                //         die("Transaksi Tidak Dapat Ditemukan");
                //     }
                //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //         $customer_id = $_POST['customer_id'];
                //         $kasir_id = $_POST['kasir_id'];
                //         $total = $_POST['total'];
                //         $barang_ids = $_POST['barang_ids'];
                //         $jumlahs = $_POST['jumlahs'];

                //         $customer = $modelUser->getUserById($customer_id);
                //         $kasir = $modelUser->getUserById($kasir_id);

                //         $barangs = [];
                //         foreach ($barang_ids as $barang_id) {
                //             $barangs[] = $modelBarang->getBarangById($barang_id);
                //         }

                //         $modelTransaksi->updateTransaksi($transaksi_id, $customer, $kasir, $total, $barangs, $jumlahs);
                //         header('Location: index.php?modul=transaksi');
                //         exit;
                //     } else {
                //         include 'views/transaksi_update.php';
                //     }
                //     break;

                // case 'edit':
                //     if (!isset($_GET['id']) || empty($_GET['id'])) {
                //         die("ID transaksi tidak ditemukan");
                //     }
                //     $transaksi_id = $_GET['id'];
                //     $transaksi = $modelTransaksi->getTransaksiById($transaksi_id);
                //     if (!$transaksi) {
                //         die("Transaksi Tidak Dapat Ditemukan");
                //     }
                //     include 'views/transaksi_update.php';
                //     break;

                // case 'delete':
                //     if (!isset($_GET['id']) || empty($_GET['id'])) {
                //         die("ID transaksi tidak ditemukan");
                //     }
                //     $transaksi_id = $_GET['id'];
                //     $cek = $modelTransaksi->getTransaksiById($transaksi_id);
                //     if (!$cek) {
                //         die("ID transaksi tidak ditemukan");
                //     }
                //     $modelTransaksi->deleteTransaksi($transaksi_id);
                //     header('Location: index.php?modul=transaksi');
                //     exit;

            default:
                $transaksis = $modelTransaksi->getAllTransaksi();
                include 'view/transaksi_list.php';
                break;
        }
        break;
    default:
        include 'view/kosong.php';
        break;
}
