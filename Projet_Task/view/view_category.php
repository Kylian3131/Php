<main>
    <h1>PAGE CATEGORIE</h1>
    <form action="category.php" method="POST">
        <h2>Ajout d'une catégorie</h2>
        <input type="text" name="name_cat" placeholder="Nom de la Catégorie">
        <input type="submit" name="addCat">
    </form>

    <p><?php echo $message ?></p>

    <h2>Liste des Catégories</h2>
    <?php echo $messageCat ?>

    <form action="category.php" method="POST">
        <h2>Modifier une catégorie</h2>
        <select name="catSelect">
            <?php echo $catOption ?>
        </select>
        <input type="text" name="newNameCat" placeholder="le Nouveau nom de la Catégorie">
        <input type="submit" name="updateCat">
    </form>

    <p><?php echo $messageUpdate ?></p>
</main>