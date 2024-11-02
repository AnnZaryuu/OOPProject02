<?php
require_once 'Model/model_role.php';



$obj_role = new Model_role();
$obj_role->AddRole('Jack O Daniel', 'Miner', 1);

foreach ($obj_role->getRole() as $Role){
    echo "Role id : " . $Role->role_id . "<br>";
}
