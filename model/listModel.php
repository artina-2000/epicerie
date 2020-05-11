<?php 
class ListModel
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
        $reponse = $this->bdd->query('SELECT produits.id,produits.designation,produits.prix,unite.nom FROM produits JOIN unite ON produits.id_unite=unite.id');
        $lists = $reponse->fetchAll();
        return $lists;
    }
    public function listUnite(){
        $reponse = $this->bdd->query('SELECT * FROM unite');
        $unites = $reponse->fetchAll();
        return $unites;
    }
    public function insererProduit($designation,$prix,$unite){
        $req = $this->bdd->prepare('INSERT INTO produits(designation,prix,id_unite) VALUES (:designation, :prix, :unite)');
        $req->execute(array(
            'designation' => $designation,
            'prix' => $prix,
            'unite' => $unite
        ));
        $id = $this->bdd->lastInsertId();
        return $id;
    }
    public function insererUnite($nom){
        $req = $this->bdd->prepare('INSERT INTO unite(nom) VALUES (:nom)');
        $req->execute(array(
            'nom' => $nom,
        ));
        $id = $this->bdd->lastInsertId();
        return $id;
    }
    public function deleteProduit($id){
        $req = $this->bdd->prepare('DELETE FROM produits WHERE id= :id');
        $req->execute([
            'id' => $id
        ]);
    }
    public function deleteUnite($id){
        $req = $this->bdd->prepare('DELETE FROM unite WHERE id= :id');
        $req->execute([
            'id' => $id
        ]);
    }
    public function selectUnite($id){
        $reponse = $this->bdd->prepare('SELECT * FROM produits WHERE id_unite= :id');
        $reponse->execute([
            'id' => $id
        ]);
        $unitexiste = $reponse->fetchAll();
        return $unitexiste;
    }
    public function validerModif($id,$nom){
        $req = $this->bdd->prepare('UPDATE unite SET nom= :nom WHERE id= :id');
            $req->execute(array(
                'id' => $id,
                'nom' => $nom
            ));
    }
    public function modifierProduit($id,$designation,$prix){
        $reponse = $this->bdd->prepare('SELECT * FROM produits WHERE id_unite= :id');
        $reponse->execute([
            'id' => $id,
            'designation' => $designation,
            'prix' => $prix
        ]);
        $produit = $reponse->fetchAll();
        return $produit;
    }
    public function validerModifprod($id,$designation,$prix,$unite){
        $req = $this->bdd->prepare('UPDATE produits SET designation= :designation, prix= :prix, id_unite= :unite WHERE id= :id');
        $req->execute(array(
            'id' => $id,
            'designation' => $designation,
            'prix' => $prix,
            'unite' => $unite
        ));
    }
    public function selectUniteById($id_unite){
            $reponse = $this->bdd->prepare('SELECT * FROM unite WHERE id= :id');
            $reponse->execute(array(
                'id' => $id_unite
            ));
            $unites = $reponse->fetchAll();
            return $unites;    
    }
}
?>