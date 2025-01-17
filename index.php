<html>
    <head>
        <meta charset="UTF-8">
        <title>To-do-list</title>
        <link href="style.css" rel="stylesheet" />
    </head>
    <body>
        <div class="form">
        <table>
            <tr>
                <td>
                    <form action="" method="post">
                        <label for="task"></label>
                        </td>
                        <td>
                        <input class="formulaire"  type="text" name="tache" placeholder="Entrez votre tâche"/>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="etat"></label>
                    </td>
                    <td>
                    <input class="formulaire" type="text" name="etat" placeholder="Importance de la tâche"/>
                </td>
            </tr>
        </table>
        </div>
        <div class="button">
        <input class="submit" type="submit" name="taskSubmit" value="Ajouter une tâche"/>
        </div>
    </form>

    <?php
    try {
        $host = 'mysql:host=localhost;dbname=to-do-list';
        $login = 'eleve2';
        $password = 'eleve';
        $pdo = new PDO($host, $login, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }


    if (isset($_POST['taskSubmit'])) {
        if (!empty($_POST['tache']) && !empty($_POST['etat'])) {
            $tache = $_POST["tache"];
            $etat = $_POST["etat"];

            $req = "INSERT INTO task (texte, etat) VALUES ('$tache','$etat')";
            $RequestStatement = $pdo->query($req);

            if ($RequestStatement) {
                if ($RequestStatement->errorCode() == '0000') {
                    echo "<br> ";
                } else {
                    echo "Erreur lors de l'insertion";
                }
            } else {
                echo "Erreur lors de la requête";
            }
        }
    }


$req = "SELECT * FROM task ORDER BY id DESC";
$RequestStatement = $pdo->query($req);

if ($RequestStatement) {
    ?>
                        <div class="main">
            <table>
                <?php
                while ($Tab = $RequestStatement->fetch()) {
                    ?>
                        <tr>
                            <td><?php echo $Tab['texte']; ?></td>
                            <td><?php echo $Tab['etat']; ?></td>
                            <td><a href="update.php?IdUpdate=<?php echo $Tab["id"] ?>"><img class="icon" src="crayon.png"/></a></td>
                            <td><a href="delete.php?IdDelete=<?php echo $Tab["id"] ?>"><img class="icon" src="poubelle.png"/></a></td>

                        </tr>
        <?php
    }
    ?>
            </table>
                        </div>
    <?php
}
?>

</body>
</html>
