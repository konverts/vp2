<?php
require_once 'models.php';
$models = new Models();
if ($_REQUEST['action'] == 'comment') {
    $models->addComment();
} elseif ($_REQUEST['action'] == 'regist') {
    $models->addUsers();
} elseif ($_REQUEST['action'] == 'auth') {
    $models->checkUsers();
}

