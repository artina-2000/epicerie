<?php 
include('../model/ListModel.php');
$listModel = new ListModel();
$id = $_POST['id'];
$designation = $_POST['designation'];
$prix = $_POST['prix'];
$id_unite = $_POST['unite'];
//var_dump($id, $nom);die();
//var_dump($id,$designation,$prix,$unite);die();
$valider = $listModel->validerModifprod($id,$designation,$prix,$id_unite);
$unite = $listModel->selectUniteById($id_unite);
//var_dump($unite[0]['nom']);die();
echo json_encode(['nom' => $unite[0]['nom']]);