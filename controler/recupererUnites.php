<?php 
include ('../model/listModel.php');
$ListModel = new ListModel();
$unites = $ListModel->listUnite();
//var_dump($unites);die();
echo json_encode(['unites'=>$unites]);