<?php

require_once 'domain_object/node_role.php';

class EmailUser {
    public $email;

    public function __construct($email) {
        $this->email = $email;
    }
}

class AggregationRole {
    public $role;
    public $email_user;

    public function __construct(Role $role, EmailUser $email_user) {
        $this->role = $role;
        $this->email_user = $email_user;
    }

    public function displayDetails() {
        echo "Role ID: " . $this->role->role_id . "<br>";
        echo "Role Name: " . $this->role->role_name . "<br>";
        echo "Role Description: " . $this->role->role_description . "<br>";
        echo "Role Status: " . $this->role->role_status . "<br>";
        echo "User Email: " . $this->email_user->email . "<br>";
    }
}
