<?php
require_once 'models2.php';
$data = new ModelsTwo();

if (isset($_GET['photo'])) {
    $data->GetFileUrl();
}elseif (isset($_GET['users'])){
$data->GetUsers();
}

