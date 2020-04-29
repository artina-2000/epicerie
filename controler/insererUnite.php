<?php 
include ('../model/listModel.php');

$nom = $_POST['nom'];
//var_dump($nom);die();
$ListModel = new ListModel();
$id = $ListModel->insererUnite($nom);
echo json_encode(['id'=>$id]);
