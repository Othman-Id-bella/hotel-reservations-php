<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Ajouter un Hôtel</title>
    <style>
        *{
            padding:10px;
        }
    </style>
</head>
<body>
    <h1>Ajouter un Hôtel</h1>
    <form action="ajouterH.php" method="post" class="form">
        <label for="titre" class="form-label">Titre :</label>
        <input type="text" name="titre" id="titre" class="form-control" required>
        <label for="adresse" class="form-label">Adresse :</label>
        <input type="text" name="adresse" id="adresse" class="form-control" required>
        <label for="prix_nuit"  class="form-label">Prix par Nuit :</label>
        <input type="number" name="prix_nuit" id="prix_nuit" class="form-control" required>
        <label for="id_type" class="form-label">Type :</label>
        <input type="number" name="id_type" id="id_type" class="form-control" required>
        <label for="nombre_de_places" class="form-label">Nombre de Places :</label>
        <input type="number" name="nombre_de_places" id="nombre_de_places"  class="form-control"required>
        <input type="submit" value="Ajouter" class="btn btn-primary">
    </form>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost:3307";  
    $username = "root@";    
    $password = "";
    $dbname ="gestion";
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }

    $titre = $_POST['titre'];
    $adresse = $_POST['adresse'];
    $prix_nuit = $_POST['prix_nuit'];
    $id_type = $_POST['id_type'];
    $nombre_de_places = $_POST['nombre_de_places'];

    
    $query = $pdo->prepare("INSERT INTO hotel (titre, adresse, prix_nuit, id_type, nombre_de_places) VALUES (?, ?, ?, ?, ?)");
    $query->execute([$titre, $adresse, $prix_nuit, $id_type, $nombre_de_places]);

    
    header('Location: listeH.php');
    exit;
}
?>