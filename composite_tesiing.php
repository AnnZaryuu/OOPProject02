<?php
require_once 'Model\composite_model.php';

$email1 = new EmailUser("Annzaryuu28993@gmail.com");
$email2 = new EmailUser("ashdaskdjgaj@gmail.com");

// Membuat objek CompositeRoleModel
$compositeRoleModel = new CompositeRoleModel();

$compositeRoleModel->tambahComposite(1, "Guardian", "Penjaga", "Active", "Annzaryuu28993@gmail.com");
$compositeRoleModel->tambahComposite(2, "Archery", "Shoot damage long range", "Active", "ThearcheryMan93@gmail.com");
$compositeRoleModel->tambahComposite(3, "Spy", "Pencari Info", "Active", "ashdaskdjgaj@gmail.com");

echo "<strong>Daftar Composite Role:</strong><br>";
foreach ($compositeRoleModel->getAllComposites() as $composite) {
    $composite->displayDetails();
}
