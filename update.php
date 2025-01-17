<html>
    <head>
        <meta charset="UTF-8">
        <title>Modifier la tache</title>
        <link href="style.css" rel="stylesheet" />
    </head>
    
    <body>
        <?php
        if(isset($_GET["IdUpdate"])){
            $idUpdate = $_GET["IdUpdate"];
            echo "<h1>Modifier la tache</h1>";
        }
        ?>
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
    
        
        <?php
          try {
            // Connexion à la base de données
            $host = 'mysql:host=localhost;dbname=to-do-list';
            $login = 'eleve2';
            $password = 'eleve';
            $pdo = new PDO($host, $login, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }

        
        //update
        if(isset($_POST['taskSubmit'])){
            if (!empty($_POST['tache']) && !empty($_POST['etat'])){
                
                $tache = $_POST["tache"];
                $etat = $_POST["etat"];
                
                $req = "UPDATE task set texte='".$tache."', etat='".$etat."' WHERE id = '".$idUpdate."'";
                $RequestStatement = $pdo->query($req);
                
                if($RequestStatement){
                    if($RequestStatement->errorCode()=='0000'){
                        echo "<h1>La tache a ete modifiée</h1> ";
                    }else{
                        echo "Erreur lors de la modification";
                    }
                }else{
                    echo "Erreur lors de la requête";
                }
            }
        }
?>
        <a href="index.php"><img class="bigicon" src="retour.png"/></a> 
    </body>
</html>