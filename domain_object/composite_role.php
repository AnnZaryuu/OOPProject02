<?php

require_once 'domain_object/node_role.php';

class EmailUser {
    public $email;
    public function __construct($email) {
        $this->email = $email;
    }
}

class Composite {
    public $role;
    public $email_user;

    // Constructor menerima data dan membuat objek Role dan EmailUser
    public function __construct($role_id, $role_name, $role_description, $role_status, $email) {
        $this->role = new Role($role_id, $role_name, $role_description, $role_status);
        $this->email_user = new EmailUser($email);
    }

    public function displayDetails() {
        echo "Role ID: " . $this->role->role_id . "<br>";
        echo "Role Name: " . $this->role->role_name . "<br>";
        echo "Role Description: " . $this->role->role_description . "<br>";
        echo "Role Status: " . $this->role->role_status . "<br>";
        echo "User Email: " . $this->email_user->email . "<br>";
    }
}
