<?php
require 'config.php';

// Démarrage de la session $_SESSION
session_start();

// récupération de l'id dans l'url
$id=($_GET['id']);

// Vérification de la soumission du formulaire via la method post
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // $_SERVER est appelée variable super globale
    // Récupération des données du formulaire
    //$name = $_POST['nom'];
    //var_dump($name);
    //$name = isset($_POST['nom']);
    $name = isset($_POST['nom']) ? trim($_POST['nom']) : '';
    $price = isset($_POST['prix']) ? trim($_POST['prix']) : '';
    $stock = isset($_POST['stock']) ? trim($_POST['stock']) : '';
    /*var_dump($name);
    var_dump($price);
    var_dump($stock);*/

    // Vérification que le champ n'est pas vide
    if ($name !== '' && $price !== '' && $stock !== '') {
        try{
            $stmt = $pdo->prepare("UPDATE produits SET nom_produit = ?, prix_produit = ?, stock_produit = ? WHERE id_produit = ?");
            $stmt->execute([$name, $price, $stock, $id]);

            // Stockage du message dans la session
            $_SESSION['message'] = "Vous avez modifié $name pour un prix de $price € à une quantité de $stock";
            $_SESSION['Retour'];
        }catch(PDOException $e){
            echo 'error  est survenue '.$e->getMessage();
        }

        header("Location: index.php");

        exit();
    } else {
        $_SESSION['message'] = "Veuillez remplir tous les champs !";
    }
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
    <title>Modifier un produit</title>
</head>
<body>
<h1>Modifier un produit</h1>
<form action="edit.php?id=<?= $id ?>" method="post">
    <div>
        <label for="nom">Nom : </label>
        <input type="text" id="nom" name="nom" required>
    </div>
    <div>
        <label for="prix">Prix : </label>
        <input type="number" id="prix" name="prix" required>
    </div>
    <div>
        <label for="stock">Stock : </label>
        <input type="number" id="stock" name="stock" required></input>
    </div>
    <div>
        <button type="submit">Modifier</button>
    </div>
</form>
<div>
    <button><a href="index.php">Retour</a></button>
</div>
<?php
// Affichage du message stocké en session
if (isset($_SESSION['message'])) {
    echo "<p>" . htmlspecialchars($_SESSION['message']) . "</p>";

    // suppression du message stocké en session
    unset($_SESSION['message']);
}
?>
</body>
</html>
