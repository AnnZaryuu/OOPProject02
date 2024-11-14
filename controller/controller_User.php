<?php
require_once 'model\model_User.php';

class controllerUser{
    private $userModel;
    public function __construct(){
        $this->userModel = new modelUser();
    }

    public function listUser(){
        $users = $this->userModel->getAllUsers();
        include 'view/user_list.php';
    }
    public function addUser($role_name, $username, $password, $name){
        $objRole = new Model_role();
        $role = $objRole->getRoleByName($role_name);
//        print_r($role);
        $this->userModel->addUser($role, $username, $password, $name);
        header('location: index.php?modul=user');
    }

    public function getUsers(){
        return $this->userModel->getAllUsers();
    }

    public function getUserById($id){
        return $this->userModel->getUserById($id);
    }

    public function getUserByName($name){
        return $this->userModel->getUserByName($name);
    }
}
?>
