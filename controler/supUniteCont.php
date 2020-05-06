<?php
include('../model/ListModel.php');

$listModel = new ListModel();
$id = $_POST['id'];
//var_dump($id);die();
$unitexiste = $listModel->selectUnite($id);
$count = count($unitexiste);
if ($count == 0) {
    $listModel->deleteUnite($id);
    echo json_encode(['status' => 'ok']);
} else {
    echo json_encode(['status' => 'ko']);
}
//echo json_encode(['id'=>$id]);
