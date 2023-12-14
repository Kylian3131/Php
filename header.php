<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <form action="task.php" method="POST">
            <input type="text" name="name_user" placeholder="Le Nom">
            <input type="text" name="first_name_user" placeholder="Le Prénom">
            <input type="text" name="login_user" placeholder="Votre Login" required>
            <input type="password" name="mdp_user" placeholder="Votre mot de passe" required>
            <input type="submit" value="Ajouter" name="submitInscription">
        </form>

        <p><?php echo $message ?></p>
    </main>
</body>
</html>
