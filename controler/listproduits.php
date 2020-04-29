<?php
include ('../model/listModel.php');

$ListModel = new ListModel();
$lists = $ListModel->listAll();
$unites = $ListModel->listUnite();
//var_dump($unites);die();

include ('../vue/listproduits.php');