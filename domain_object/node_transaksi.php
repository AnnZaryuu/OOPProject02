<?php

class Transaksi
{
    public $idTransaksi;
    public $tgl_transaksi;
    public $customer;
    public $kasir;
    public $total;
    public $barangs;
    public $jumlahs;

    public function __construct($idTransaksi, $tgl_transaksi, $customer, $kasir, $total, $barangs, $jumlahs)
    {
        $this->idTransaksi = $idTransaksi;
        $this->tgl_transaksi = $tgl_transaksi;
        $this->customer = $customer;
        $this->kasir = $kasir;
        $this->total = $total;
        $this->barangs = $barangs;
        $this->jumlahs = $jumlahs;
    }
}
