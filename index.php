<?php
// importation du config.php
require 'config.php';

// insertion avec une requête préparée -> mieux pour la sécu
// $stmt = $pdo->prepare('INSERT INTO truc (machin) VALUES (?)'); /* prepare est une fonction qui est dans la classe pdo */
// $stmt->execute([$bidule]);


// Préparation de la requête
$query = "SELECT * FROM produits";

// Exécution de la requête
$stmt = $pdo->query($query); // sorte de convention d'utiliser la variable $stmt (pour statement)

// Récupération des données sous forme d'un tableau associatif
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

// print_r($produits);

?>
<!-- Edition et suppression -->
<!-- edit.php et delete.php -->
<!--<a href="edit.php?id="<?php /*= $produits['id']; */?>>Modifier</a>-->
<!--$id = $GET['id'];-->

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="index.css">
    <title>Liste produits</title>
</head>
<body>
<?php if (!empty($produits)): ?>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Stock</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        </thead>
        <tbody>
        <!-- PHP -->
        <?php foreach ($produits as $p): ?> <!-- les ":" c'est pour éviter d'ouvrir l'accolade du foreach -->
            <tr>
                <!-- on utilise ?= pour faire un echo -->
                <td><?=  htmlspecialchars($p['id_produit'])  ?></td>
                <td><?=  htmlspecialchars($p['nom_produit'])  ?></td>
                <td><?=  htmlspecialchars($p['prix_produit'] . ' €')  ?></td>
                <td><?=  htmlspecialchars($p['stock_produit'])  ?></td>
                <td><button><a href="edit.php?id="<?= $p['id_produit']; ?>>Modifier</a></button></td>
                <td><button><a href="delete.php?id="<?= $p['id_produit']; ?>>Supprimer</a></button></td>
            </tr>
        <?php endforeach; ?> <!-- là on ferme l'accolade du foreach en gros -->
        </tbody>
    </table>
<?php else: ?>
    <p>Aucun produit</p>
<?php endif; ?>

</body>
</html>
