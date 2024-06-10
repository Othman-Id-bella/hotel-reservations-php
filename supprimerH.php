<?php
$servername = "localhost:3307";  
$username = "root@";    
$password = "";
$dbname ="gestion";;

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

if (isset($_GET['id'])) {
    $id_hotel = $_GET['id'];

    $query = $pdo->prepare("DELETE FROM hotel WHERE id_hotel = ?");
    $query->execute([$id_hotel]);

    header('Location: listeH.php');
    exit;
}
?>
