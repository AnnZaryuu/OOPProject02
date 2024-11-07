<?php
class RoleBarang {
    public $barang_id;
    public $barang_name;
    public $barang_harga;
    public $barang_jenis;

    public function __construct($barang_id, $barang_name, $barang_harga, $barang_jenis) {
        $this->barang_id = $barang_id;
        $this->barang_name = $barang_name;
        $this->barang_harga = $barang_harga;
        $this->barang_jenis = $barang_jenis;
    }
}
?>
