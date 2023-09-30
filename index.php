<?php
// Inclure les fichiers des classes
require_once './class/CRUD.php';
require_once './class/voiture.php';

$host = 'localhost';
$db = 'sparadis_tp1'; // Utilisez le nom de votre base de données
$user = 'root';
$password = '';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

try {
    $oPDO = new PDO($dsn, $user, $password);

    if ($oPDO) {
        echo "Connecté à la base de données $db avec succès !";
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

// Création d'une instance de la classe Voiture
$voitureOperator = new Voiture($host, $db, $user, $password);

// Afficher tous les éléments de la base de données
$voitures = $voitureOperator->getCars();
foreach ($voitures as $voiture) {
    echo "ID: {$voiture['id']}, Marque: {$voiture['marque']}, Année de fabrication: {$voiture['annee_fabrication']}, Type: {$voiture['type']}, Prix neuf: {$voiture['prix_neuf']}<br>";
}

// Afficher un élément en le sélectionnant par son ID
$voitureById = $voitureOperator->getCarById(1);

print_r($voitureById);

// Ajouter une nouvelle voiture
$newVoitureData = [
    'marque' => 'Nissan',
    'annee_fabrication' => 2023,
    'type' => 'SUV',
    'prix_neuf' => 28000
];

echo "<br><br>";

$idNouvelleVoiture = $voitureOperator->addCar($newVoitureData);
if ($idNouvelleVoiture !== false) {
    echo "Votre nouvelle voiture a été ajoutée avec l'ID : $idNouvelleVoiture<br>";
} else {
    echo "Une erreur est survenue lors de l'ajout de la nouvelle voiture<br>";
}

// Modifier une voiture existante
$idToEdit = 2;
$updatedVoitureData = [
    'prix_neuf' => 55000
];

if ($voitureOperator->updateCarById($idToEdit, $updatedVoitureData)) {
    echo "Voiture avec l'ID : $idToEdit modifiée avec succès<br>";
} else {
    echo "Une erreur est survenue lors de la modification de la voiture<br>";
}

// Supprimer une voiture
$idToDelete = 3;
if ($voitureOperator->deleteCar($idToDelete)) {
    echo "Voiture avec l'ID : $idToDelete supprimée avec succès<br>";
} else {
    echo "Une erreur est survenue lors de la suppression de la voiture<br>";
}

// Fermer la connexion à la base de données
unset($voitureOperator);
?>
