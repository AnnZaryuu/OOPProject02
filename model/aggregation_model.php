<?php

require_once 'domain_object/Aggregation_role.php';  


class RoleModel
{
    private $roles = [];

    public function tambahRole($idPeran, $namaPeran, $descPeran, $statusPekerjaan, EmailUser $emailUser)
    {
        $role = new Role($idPeran, $namaPeran, $descPeran, $statusPekerjaan); 
        $aggregatedRole = new AggregationRole($role, $emailUser);
        $this->roles[] = $aggregatedRole; 
    }

    public function getAllRoles()
    {
        return $this->roles;
    }

    public function hapusRole($idPeran)
    {
        foreach ($this->roles as $index => $aggregatedRole) {
            if ($aggregatedRole->role->role_id == $idPeran) {
                unset($this->roles[$index]);
            }
        }
        $this->roles = array_values($this->roles);  // Mengatur ulang indeks array
    }
}
