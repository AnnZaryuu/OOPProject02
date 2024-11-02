<?php
require_once 'Model\aggregation_model.php';


$email1 = new EmailUser("Annzaryuu28993@gmail.com");
$email2 = new EmailUser("ashdaskdjgaj@gmail.com");


$roleModel = new RoleModel();


$roleModel->tambahRole(1, "Guardian", "Penjaga",1, $email1);
$roleModel->tambahRole(2, "Spy", "Pencari Info",1, $email2);

echo "<strong>Daftar Role:</strong><br>";
foreach ($roleModel->getAllRoles() as $role) {
    $role->displayDetails();
}


