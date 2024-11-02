<?php

require_once 'domain_object/node_role.php' ;

    class Model_role{
        private $Roles = [];
        
        private $Nextid = 1;

        public function __construct(){
            if(isset($_SESSION['Roles'])){
                $this->Roles = unserialize($_SESSION['Roles']);
                $this->Nextid = count( $this->Roles ) + 1;
        }
            else{
                $this->initializeDefaultRole();
            }
    }
    public function initializeDefaultRole(){
        $this->AddRole('Anjar','Mahasiswa', 1);

    }

    public function AddRole($name, $description, $role_status){
        $peran = new Role($this->Nextid++,$name, $description, $role_status);
        $this->Roles [] = $peran;
        $this->SaveToSesion();
    }

    private function SaveToSesion(){
        $_SESSION['Roles'] = serialize( $this->Roles );
    }

    public function getRole(){
        return $this->Roles;
    }

    public function GetAllRoles(){
        return $this->Roles;
    }

    public function GetRoleById($role_id){
        foreach ($this->Roles as $Role) {
            if($Role->role_id == $role_id){
                return $Role;
            }
        }
        return null;
    }
    
    public function UpdateRole($role_id,$name, $description, $role_status){
        foreach ($this->Roles as $Role) {
            if ($this->$role_id == $role_id) {
                $Role->role_name = $name;
                $Role->role_description= $description;
                $Role->$role_status = $role_status;
                $this->SaveToSesion();
                return true;
            }
        }
        return false;
    }

    public function DeleteRole($role_id){
        foreach ($this->Roles as $key => $Role) {
            if ($this->$role_id == $role_id) {
                unset($this->Roles[$key]);
                $this->Roles = array_values($this->Roles);
                $this->SaveToSesion();
                return true;
            }
    }
    return false;
    }

    public function getRoleByName($name){
        foreach ($this->Roles as $Role) {
            if ($Role->role_name == $name) {
                return $Role;
            }

        }
    }
}