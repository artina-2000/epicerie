<?php
include('../model/ListModel.php');

$listModel = new ListModel();
$id = $_POST['id'];
//var_dump($id);die();
$listModel->deleteUnite($id);
//echo json_encode(['id'=>$id]);
