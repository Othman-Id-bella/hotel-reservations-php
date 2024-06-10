<?php
$servername = "localhost:3307";  
$username = "root@";    
$password = "";
$dbname ="gestion";
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Impossible de se connecter à la base de données : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_hotel = $_POST['id_hotel'];
    $titre = $_POST['titre'];
    $adresse = $_POST['adresse'];
    $prix_nuit = $_POST['prix_nuit'];
    $id_type = $_POST['id_type'];
    $nombre_de_places = $_POST['nombre_de_places'];

    // Mettre à jour l'hôtel
    $sql = 'UPDATE hotel SET titre = ?, adresse = ?, prix_nuit = ?, id_type = ?, nombre_de_places = ? WHERE id_hotel = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titre, $adresse, $prix_nuit, $id_type, $nombre_de_places, $id_hotel]);

    header('Location: listeH.php');
    exit();

    
} else {

    $id_hotel = $_GET['id'];
    $sql = 'SELECT * FROM hotel WHERE id_hotel = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_hotel]);
    $hotel = $stmt->fetch(PDO::FETCH_ASSOC);

    
        
    if (!$hotel) {
        echo 'Hôtel non trouvé';
    exit();
    }
    header('Location: listeH.php');
}   

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <title>Modifier Hôtel</title>
    <style>
        *{
            padding: 10px;
        }
    </style>
</head>
<body>
<h1>Modifier Hôtel</h1>
    <form action="modifierH.php" method="post">
        <input type="hidden" name="id_hotel" class="form-control" value="<?php echo htmlspecialchars($hotel['id_hotel']); ?>">
        <label for="titre" class="form-label">Titre :</label>
        <input type="text" id="titre" name="titre" class="form-control" value="<?php echo ($hotel['titre']); ?>" >
        <label for="adresse" class="form-label">Adresse :</label>
        <input type="text" id="adresse" name="adresse" class="form-control" value="<?php echo htmlspecialchars($hotel['adresse']); ?>" required><br>
        <label for="prix_nuit" class="form-label">Prix par nuit :</label>
        <input type="text" id="prix_nuit" name="prix_nuit" class="form-control" value="<?php echo htmlspecialchars($hotel['prix_nuit']); ?>" required><br>
        <label for="nombre_de_places" class="form-label">Nombre de places :</label>
        <input type="number" id="nombre_de_places" name="nombre_de_places" class="form-control" value="<?php echo htmlspecialchars($hotel['nombre_de_places']); ?>" required><br>
        <input type="submit" value="Modifier" class="btn btn-info">
    </form>
</body>
</html>
