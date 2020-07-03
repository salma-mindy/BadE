<?php
class Produits{
    // Connexion
    private $connexion;
    private $table = "ville";

    // object properties
    public $id;
    public $ville;
    public $lat;
    public $lng;


    /**
     * Constructeur avec $db pour la connexion à la base de données
     *
     * @param $db
     */
    public function __construct($db1){
        $this->connexion = $db1;
    }

    /**
     * Lecture des produits
     *
     * @return void
     */
    public function lire(){
        // On écrit la requête
        $sql = "SELECT `id`, `ville`, `lat`, `lng` FROM `ville`";

        // On prépare la requête
        $query = $this->connexion->prepare($sql);

        // On exécute la requête
        $query->execute();

        // On retourne le résultat
        return $query;
    }

    /**
     * Créer un produit
     *
     * @return void
     */
    public function creer(){

        // Ecriture de la requête SQL en y insérant le ville de la table
        $sql = "INSERT INTO " . $this->table . " SET ville=:ville, lng=:lng, lat=:lat";

        // Préparation de la requête
        $query = $this->connexion->prepare($sql);

        // Protection contre les injections
        $this->ville=htmlspecialchars(strip_tags($this->ville));
        $this->lng=htmlspecialchars(strip_tags($this->lng));
        $this->lat=htmlspecialchars(strip_tags($this->lat));


        // Ajout des données protégées
        $query->bindParam(":ville", $this->ville);
        $query->bindParam(":lng", $this->lng);
        $query->bindParam(":lat", $this->lat);
    

        // Exécution de la requête
        if($query->execute()){
            return true;
        }
        return false;
    }

    /**
     * Lire un produit
     *
     * @return void
     */
    public function lireUn(){
        // On écrit la requête
        $sql = "SELECT ville as id, ville, lat, lng FROM " . $this->table . " WHERE id = ? LIMIT 0,1";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On attache l'id
        $query->bindParam(1, $this->id);

        // On exécute la requête
        $query->execute();

        // on récupère la ligne
        $row = $query->fetch(PDO::FETCH_ASSOC);

        // On hydrate l'objet
        $this->ville = $row['ville'];
        $this->lng = $row['lng'];
        $this->lat = $row['lat'];

    }

    /**
     * Supprimer un produit
     *
     * @return void
     */
    public function supprimer(){
        // On écrit la requête
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On sécurise les données
        $this->id=htmlspecialchars(strip_tags($this->id));

        // On attache l'id
        $query->bindParam(1, $this->id);

        // On exécute la requête
        if($query->execute()){
            return true;
        }
        
        return false;
    }

    /**
     * Mettre à jour un produit
     *
     * @return void
     */
    public function modifier(){
        // On écrit la requête
        $sql = "UPDATE " . $this->table . " SET ville = :ville, lng = :lng, lat = :lat WHERE id = :id";
        
        // On prépare la requête
        $query = $this->connexion->prepare($sql);
        
        // On sécurise les données
        $this->ville=htmlspecialchars(strip_tags($this->ville));
        $this->lng=htmlspecialchars(strip_tags($this->lng));
        $this->lat=htmlspecialchars(strip_tags($this->lat));
        
        // On attache les variables
        $query->bindParam(':ville', $this->ville);
        $query->bindParam(':lng', $this->lng);
        $query->bindParam(':lat', $this->lat);
        $query->bindParam(':id', $this->id);
        
        // On exécute
        if($query->execute()){
            return true;
        }
        
        return false;
    }

}