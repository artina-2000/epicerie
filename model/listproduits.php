<?php 
class ListProduit
{
    private $bdd;
    public function __construct(){
        try{ 
            $this->bdd = new PDO('mysql:host=localhost;dbname=epicerie', 'root', '');
        }catch(Exception $e){
            die('error: '.$e->getMessage());
        } 
    }
    public function listAll(){
        $reponse = $this->bdd->query('SELECT * FROM produits JOIN unite ON produits.id_unite=unite.id');
        $lists = $reponse->fetchAll();
        return $lists;
    }
    public function listUnite(){
        $reponse = $this->bdd->query('SELECT * FROM unite');
        $unites = $reponse->fetchAll();
        return $unites;
    }
}
?>