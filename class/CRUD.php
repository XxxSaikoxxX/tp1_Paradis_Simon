<?php
abstract class CRUD
{
    protected $pdo;

    public function __construct($host, $database, $username, $password)
    {
        try {
            // Établir la connexion à la base de données
            $this->pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Gérer les erreurs de connexion
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    // Obtenir la liste des voitures
    abstract public function getCars();

    // Obtenir une voiture par son identifiant
    abstract public function getCarById($id);

    // Ajouter une nouvelle voiture
    abstract public function addCar($car);

    // Mettre à jour une voiture par son identifiant
    abstract public function updateCarById($id, $data);

    // Supprimer une voiture par son identifiant
    abstract public function deleteCar($id);
}
?>
