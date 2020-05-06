<?php 
include('../model/ListModel.php');
$listModel = new ListModel();
$id = $_POST['id'];
$nom = $_POST['nom'];
//var_dump($id, $nom);die();
$valider = $listModel->validerModif($id,$nom);
