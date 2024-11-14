<?php
require_once __DIR__ . '/../domain_object/node_User.php';

class ModelUser
{
    private $users = [];
    private $nextId = 1;
    private $modelRole;

    public function __construct($modelRole)
    {
        $this->modelRole = $modelRole;
        if (isset($_SESSION['users'])) {
            $this->users = unserialize($_SESSION['users']);
            $this->nextId = count($this->users) + 1;
        } else {
            $this->initializeDefaultUser();
        }
    }

    public function initializeDefaultUser()
    {
        $this->addUser("Gayuh", "gayuh123", password_hash("password1", PASSWORD_DEFAULT), 1);
        $this->addUser("Ginanjar", "ginanjar123", password_hash("password2", PASSWORD_DEFAULT), 2);
        $this->addUser("Laksono", "laksono123", password_hash("password3", PASSWORD_DEFAULT), 3);
    }


    public function addUser($user_nama, $user_username, $user_password, $role_id)
    {
        $role = $this->modelRole->getRoleById($role_id);
        if ($role) {
            $usr = new User($this->nextId++, $user_nama, $user_username, $user_password, $role);
            $this->users[] = $usr;
            $this->saveToSession();
        } else {
            throw new Exception("Role tidak ditemukan untuk ID: $role_id");
        }
    }

    private function saveToSession()
    {
        $_SESSION['users'] = serialize($this->users);
    }

    public function getAllUser()
    {
        return $this->users;
    }

    public function getUserById($user_id)
    {
        foreach ($this->users as $user) {
            if ($user->user_id == $user_id) {
                return $user;
            }
        }
        return null;
    }

    public function updateUser($user_id, $user_nama, $user_username, $user_password, $user_role_id)
    {
        foreach ($this->users as $user) {
            if ($user->user_id == $user_id) {
                $user->user_nama = $user_nama;
                $user->user_username = $user_username;
                $user->user_password = $user_password;
                $role = $this->modelRole->getRoleById($user_role_id);
                $user->role = $role;
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }



    public function deleteUser($user_id)
    {
        foreach ($this->users as $key => $user) {
            if ($user->user_id == $user_id) {
                unset($this->users[$key]);
                $this->users = array_values($this->users);
                $this->saveToSession();
                return true;
            }
        }
        return false;
    }

    public function getUserByUsername($user_username)
    {
        foreach ($this->users as $user) {
            if ($user->user_username == $user_username) {
                return $user;
            }
        }
        return null;
    }


    public function getUserByRole($role)
    {
        $result = [];
        if (is_string($role)) {
            foreach ($this->users as $user) {
                if ($user->role->role_name == $role) {
                    $result[] = $user;
                }
            }
        } elseif (is_object($role) && isset($role->role_name)) {
            foreach ($this->users as $user) {
                if ($user->role->role_name == $role->role_name) {
                    $result[] = $user;
                }
            }
        }

        return $result;
    }



    public function getUserByName($user_nama)
    {
        foreach ($this->users as $user) {
            if ($user->user_nama == $user_nama) {
                return $user;
            }
        }
        return null;
    }
}
