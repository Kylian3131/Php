<main>
        <!-- Formulaire d'inscription d'un Utilisateur -->
        <form action="index.php" method="POST">
            <input type="text" name="name_user" placeholder="Le Nom">
            <input type="text" name="first_name_user" placeholder="Le Prénom">
            <input type="text" name="login_user" placeholder="Votre Login" required>
            <input type="password" name="mdp_user" placeholder="Votre mot de passe" required>
            <input type="submit" value="Ajouter" name="submitInscription">
        </form>

        <!-- Message d'inscription d'un Utilisateur -->
        <p><?php echo $message ?></p>

        <!-- Section affichant l'ensemble des utilisateurs -->
        <section>
            <?php echo $showUsers ?>
        </section>

        <!-- Formulaire de sélection d'un Utilisateur à modifier -->
        <form action="index.php" method="POST">
            <select name="selectUser">
                <?php echo $selectUser ?>
            </select>
            <input type="submit" value="Selectionner" name="submitSelect">
        </form>

        <!-- Formulaire de modification d'un Utilisateur -->
        <?php echo $formUpdateUser ?>

        <!-- Message de modification d'un Utilisateur -->
        <p><?php echo $messageUpdate ?></p>
</main>