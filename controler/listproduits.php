<?php
include ('../model/listproduits.php');

$listProduit = new ListProduit();
$lists = $listProduit->listAll();
$unites = $listProduit->listUnite();
//var_dump($unites);die();

include ('../vue/listproduits.php');