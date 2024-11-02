<?php

require_once 'Model\Inharitance_model.php';


$roleModel = new RoleModel();

$roleModel->tambahRole(1, "Manager", "Mengelola tim", 1, 5000);
$roleModel->tambahRole(2, "Team Leader", "Memimpin tim", 1, 4000);


$roleModel->addSubRole(1, new Role(3, "Developer", "Mengembangkan aplikasi", 1));
$roleModel->addSubRole(1, new Role(4, "Designer", "Mendesain antarmuka", 1));


echo "<strong>Daftar Role:</strong><br>";
foreach ($roleModel->getAllRoles() as $role) {
    $role->displayDetails();
}
