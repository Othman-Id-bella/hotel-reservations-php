<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <style>
        *{
            padding: 10px;
        }
    </style>
</head>
<body>
<?php
$servername = "localhost:3307";  
$username = "root@";    
$password = "";
$dbname ="gestion";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}


$query = $conn->query("SELECT * FROM hotel");
$hotels = $query->fetchAll(PDO::FETCH_ASSOC);
?>
    <h1>Liste des Hôtels</h1>
    <table class="table table-striped">
        <tr>
            <th>ID Hôtel</th>
            <th>Titre</th>
            <th>Adresse</th>
            <th>Prix par Nuit</th>
            <th>Type</th>
            <th>Nombre de Places</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($hotels as $hotel): ?>
            <tr>
                <td><?php echo $hotel['id_hotel']; ?></td>
                <td><?php echo $hotel['titre']; ?></td>
                <td><?php echo $hotel['adresse']; ?></td>
                <td><?php echo $hotel['prix_nuit']; ?> DH</td>
                <td><?php echo $hotel['id_type']; ?></td>
                <td><?php echo $hotel['nombre_de_places']; ?></td>
                <td>
                    <a href="modifie.php?id=<?php echo $hotel ['id_hotel'] ?>" type="button" class="btn btn-success">Modifie</a>
                    <a href="supprimerH.php?id=<?php echo $hotel ['id_hotel'] ?>"  type="button" class="btn btn-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="ajouterH.php" type="button" class="btn btn-dark">Ajouter un nouvel hôtel</a>
</body>
</html>

