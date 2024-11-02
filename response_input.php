<?php
require_once 'domain_object/node_role.php';
$obj_role =[];
$obj_role[] = new Role(1,$_POST['role_name'],$_POST['role_description'],$_POST['role_status']);
include 'view/role_list.php';
