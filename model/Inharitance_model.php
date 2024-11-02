<?php

require_once 'domain_object\Inharitance_role.php';

class RoleModel {
    private $roles = [];

    public function tambahRole($idPeran, $namaPeran, $descPeran, $statusPekerjaan, $salary) {
        $role = new Inharitance_Role($idPeran, $namaPeran, $descPeran, $statusPekerjaan, $salary);
        $this->roles[] = $role;
    }

    public function addSubRole($role_id, Role $subRole) {
        foreach ($this->roles as $role) {
            if ($role->role_id == $role_id) {
                $role->addSubRole($subRole); // Menambahkan sub-role
            }
        }
    }

    public function getAllRoles() {
        return $this->roles;
    }

    public function hapusRole($idPeran) {
        foreach ($this->roles as $index => $role) {
            if ($role->role_id == $idPeran) {
                unset($this->roles[$index]);
            }
        }
        $this->roles = array_values($this->roles); // Mengatur ulang indeks array
    }
}
