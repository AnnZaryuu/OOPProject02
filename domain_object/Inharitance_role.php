<?php

require_once 'domain_object/node_role.php';

class Inharitance_Role extends Role {
    private $subRoles = [];
    public $salary;

    public function __construct($role_id, $role_name, $role_description, $role_status, $salary) {
        parent::__construct($role_id, $role_name, $role_description, $role_status);
        $this->salary = $salary;
    }

    public function addSubRole(Role $role) {
        $this->subRoles[] = $role; 
    }

    public function removeSubRole($role_id) {
        foreach ($this->subRoles as $index => $role) {
            if ($role->role_id == $role_id) {
                unset($this->subRoles[$index]);
            }
        }
        $this->subRoles = array_values($this->subRoles); 
    }

    public function getSubRoles() {
        return $this->subRoles;
    }

    public function displayDetails() {
        echo "Role ID: " . $this->role_id . "<br>";
        echo "Role Name: " . $this->role_name . "<br>";
        echo "Role Description: " . $this->role_description . "<br>";
        echo "Role Status: " . $this->role_status . "<br>";
        echo "Salary: " . $this->salary . "<br>";
        echo "Sub Roles: <br>";

        if (empty($this->subRoles)) {
            echo "No sub-roles available.<br>";
        } else {
            foreach ($this->subRoles as $subRole) {
                echo "- " . $subRole->role_name . "<br>";
            }
        }
    }
}
