<?php
require 'config.php';

// Démarrage de la session $_SESSION
session_start();

// récupération de l'id dans l'url
$id=($_GET['id']);

try{
    $stmt = $pdo->prepare("DELETE FROM produits WHERE id_produit = ?");
    $stmt->execute([$id]);

    // Stockage du message dans la session
    $_SESSION['message'] = "Vous avez bien supprimé votre article !";
}catch(PDOException $e){
    echo 'error  est survenue '.$e->getMessage();
}



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="index.css">
    <title>Supprimer un produit</title>
</head>
<body>

<?php
// Affichage du message stocké en session

    echo "<p>" . htmlspecialchars($_SESSION['message']) . "</p>";
    // suppression du message stocké en session
    unset($_SESSION['message']);

header("Location: index.php");

?>

</body>
</html>
