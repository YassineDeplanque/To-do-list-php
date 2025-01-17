<html>
    <head>
        <meta charset="UTF-8">
        <title>Supprimer la tache</title>
        <link href="style.css" rel="stylesheet" />
    </head>
    
    <body>
        <?php
        if(isset($_GET["IdDelete"])){
            $idTask = $_GET["IdDelete"];
            echo "<br>";
        }
        ?>
        
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

        
        //delete 
                $req = "DELETE FROM task WHERE id = '".$idTask."'";
                $RequestStatement = $pdo->query($req);
                
                if($RequestStatement){
                    if($RequestStatement->errorCode()=='0000'){
                        echo "<h1> La tache a été supprimée </h1> <br> ";
                    }else{
                        echo "Erreur lors de la suppression";
                    }
                }else{
                    echo "Erreur lors de la requête";
                }
?>
        <a href="index.php"><img class="bigicon" src="retour.png"/></a>   
    </body>
</html>