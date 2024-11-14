<?php
class User
{
    public $user_id;
    public $user_nama;
    public $user_username;
    public $user_password;
    public $role;

    function __construct($user_id, $user_nama, $user_username, $user_password, $role)
    {
        $this->user_id = $user_id;
        $this->user_nama = $user_nama;
        $this->user_username = $user_username;
        $this->user_password = $user_password;
        $this->role = $role;
    }
}
