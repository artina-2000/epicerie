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

}
?>