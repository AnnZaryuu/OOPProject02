<?php

require_once 'domain_object\node_barang.php';

class Model_barang {
    private $Barangs = [];
    private $Nextid = 1;

    public function __construct() {
        if (isset($_SESSION['Barangs'])) {
            $this->Barangs = unserialize($_SESSION['Barangs']);
            $this->Nextid = count($this->Barangs) + 1;
        } else {
            $this->initializeDefaultBarang();
        }
    }

    public function initializeDefaultBarang() {
        $this->AddBarang('Laptop', 'Elektronik', 5000000);
    }

    public function AddBarang($name, $jenis, $harga) {
        $barang = new RoleBarang($this->Nextid++, $name, $harga, $jenis);
        $this->Barangs[] = $barang;
        $this->SaveToSession();
    }

    private function SaveToSession() {
        $_SESSION['Barangs'] = serialize($this->Barangs);
    }

    public function getBarang() {
        return $this->Barangs;
    }

    public function GetAllBarangs() {
        return $this->Barangs;
    }

    public function GetBarangById($barang_id) {
        foreach ($this->Barangs as $Barang) {
            if ($Barang->barang_id == $barang_id) {
                return $Barang;
            }
        }
        return null;
    }

    public function UpdateBarang($barang_id, $name, $jenis, $harga) {
        foreach ($this->Barangs as $Barang) {
            if ($Barang->barang_id == $barang_id) {
                $Barang->barang_name = $name;
                $Barang->barang_jenis = $jenis;
                $Barang->barang_harga = $harga;
                $this->SaveToSession();
                return true;
            }
        }
        return false;
    }

    public function DeleteBarang($barang_id) {
        foreach ($this->Barangs as $key => $Barang) {
            if ($Barang->barang_id == $barang_id) {
                unset($this->Barangs[$key]);
                $this->Barangs = array_values($this->Barangs); // Reindex array setelah penghapusan
                $this->SaveToSession();
                return true;
            }
        }
        return false;
    }

    public function getBarangByName($name) {
        foreach ($this->Barangs as $Barang) {
            if ($Barang->barang_name == $name) {
                return $Barang;
            }
        }
        return null;
    }
}
?>
