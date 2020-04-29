<?php 
include ('../model/listModel.php');

$designation = $_POST['designation'];
$prix = $_POST['prix'];
$nom = $_POST['nom'];
$unite = $_POST['unite'];

$ListModel = new ListModel();
$id = $ListModel->insererProduit($designation,$prix,$unite);

echo json_encode(['id'=>$id]);

//var_dump($designation,$prix,$nom,$unite);die();
