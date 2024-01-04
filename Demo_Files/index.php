<!DOCTYPE html>
<html>

<head>
    <title>Inscription Utilisateur</title>
</head>

<body>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <label for="name_user">Nom :</label>
        <input type="text" name="name_user" id="name_user" required>

        <label for="login">Login :</label>
        <input type="text" name="login" id="login" required>

        <label for="password_user">Mot de passe :</label>
        <input type="password" name="password_user" id="password_user" required>

        <label for="img">Image de profil :</label>
        <input type="file" name="img" id="img" required>

        <input type="submit" value="Enregistrer">
    </form>

    <?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'users';

    try {
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name_user = $_POST['name_user'];
            $login = $_POST['login'];
            $password_user = password_hash($_POST['password_user'], PASSWORD_DEFAULT);
            $tmpName = $_FILES['img']['tmp_name'];
            $img = $_FILES['img']['name'];
            $file = new SplFileInfo($_FILES['img']['name']);
            $ext = strtolower($file->getExtension());
            $size = $_FILES['img']['size'];

            // Traitement de l'image
            if (in_array($ext, ['jpg', 'gif', 'png', 'jpeg'])) {
                $dimension = getimagesize($tmpName);
                $width = $dimension[0];
                $height = $dimension[1];

                if ($width <= 400 && $height <= 400) {
                    if ($size <= 2097152) {
                        $uploadPath = './img/' . $img;
                        move_uploaded_file($tmpName, $uploadPath);
                    } else {
                        echo "<p>Image trop lourde</p>";
                    }
                } else {
                    echo "<p>Image trop grande</p>";
                }
            } else {
                echo "<p>Format d'image invalide</p>";
            }

            // Insertion des données dans la base de données
            if (isset($uploadPath)) {
                $req = $conn->prepare("INSERT INTO users (name_user, login, password_user, img) VALUES (?, ?, ?, ?)");
                $req->bindParam(1, $name_user);
                $req->bindParam(2, $login);
                $req->bindParam(3, $password_user);
                $req->bindParam(4, $uploadPath);

                if ($req->execute()) {
                    echo "<p>Utilisateur enregistré avec succès.</p>";
                } else {
                    echo "<p>Erreur lors de l'enregistrement de l'utilisateur.</p>";
                }
            }
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
    ?>

</body>

</html>