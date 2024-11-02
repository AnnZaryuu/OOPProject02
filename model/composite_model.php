<?php

// require_once 'domain_object/node_role.php';
require_once 'domain_object\composite_role.php';

class CompositeRoleModel
{
    private $composites = [];

    // Method untuk menambah Composite (Role dan EmailUser)
    public function tambahComposite($idPeran, $namaPeran, $descPeran, $statusPekerjaan, $emailUser)
    {
        $composite = new Composite($idPeran, $namaPeran, $descPeran, $statusPekerjaan, $emailUser);
        $this->composites[] = $composite; // Menambah objek Composite ke array
    }

    public function getAllComposites()
    {
        return $this->composites;
    }

    public function hapusComposite($idPeran)
    {
        foreach ($this->composites as $index => $composite) {
            if ($composite->role->role_id == $idPeran) {
                unset($this->composites[$index]);
            }
        }
        $this->composites = array_values($this->composites); // Mengatur ulang indeks array
    }
}
