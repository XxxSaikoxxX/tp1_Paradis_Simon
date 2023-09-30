<?php
class Voiture extends CRUD
{
    // Obtient la liste des voitures
    public function getCars()
    {
        $oPDOStmt = $this->pdo->query("SELECT id, marque, annee_fabrication, type, prix_neuf FROM voiture ORDER BY id ASC");
        $voitures = $oPDOStmt->fetchAll(PDO::FETCH_ASSOC);
        return $voitures;
    }

    // Obtient une voiture par son identifiant
    public function getCarById($id)
    {
        $oPDOStmt = $this->pdo->prepare("SELECT id, marque, annee_fabrication, type, prix_neuf FROM voiture WHERE id = :id");
        $oPDOStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $oPDOStmt->execute();
        $voiture = $oPDOStmt->fetchAll(PDO::FETCH_ASSOC);
        return $voiture;
    }

    // Ajoute une nouvelle voiture
    public function addCar($car)
    {
        try {
            $oPDOStmt = $this->pdo->prepare('INSERT INTO voiture SET marque=:marque, annee_fabrication=:annee_fabrication, type=:type, prix_neuf=:prix_neuf');
            $oPDOStmt->bindParam(':marque', $car['marque'], PDO::PARAM_STR);
            $oPDOStmt->bindParam(':annee_fabrication', $car['annee_fabrication'], PDO::PARAM_INT);
            $oPDOStmt->bindParam(':type', $car['type'], PDO::PARAM_STR);
            $oPDOStmt->bindParam(':prix_neuf', $car['prix_neuf'], PDO::PARAM_INT);
            $oPDOStmt->execute();
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Met à jour une voiture par son identifiant
    public function updateCarById($id, $data)
    {
        try {
            $oPDOStmt = $this->pdo->prepare('UPDATE voiture SET marque=:marque, annee_fabrication=:annee_fabrication, type=:type, prix_neuf=:prix_neuf WHERE id=:id');
            $oPDOStmt->bindParam(':marque', $data['marque'], PDO::PARAM_STR);
            $oPDOStmt->bindParam(':annee_fabrication', $data['annee_fabrication'], PDO::PARAM_INT);
            $oPDOStmt->bindParam(':type', $data['type'], PDO::PARAM_STR);
            $oPDOStmt->bindParam(':prix_neuf', $data['prix_neuf'], PDO::PARAM_INT);
            $oPDOStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $result = $oPDOStmt->execute();
            
            if ($result) {
                return $oPDOStmt->rowCount() > 0;
            } else {
                return false; // Retournez false en cas d'erreur
            }
        } catch (PDOException $e) {
            return false; // Retournez false en cas d'erreur
        }
    }

    // Supprime une voiture par son identifiant
    public function deleteCar($id)
    {
        $oPDOStmt = $this->pdo->prepare("DELETE FROM voiture WHERE id=:id");
        $oPDOStmt->bindParam(':id', $id, PDO::PARAM_INT);
        $resultat = $oPDOStmt->execute();
        return $resultat;
    }
}
?>
