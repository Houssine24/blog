<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Mon blog</title> 
</head>

<body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <div class="element">
            <a href="blogphp.html">Bienvenue</a>
        </div>
        <div class="element">
            <a href="AjoutArticles.php">Ajouter un Article</a>
        </div>
        <h1>Mon Blog</h1>
        <div class="element">        
            <a href="ModifierArticles.php">Modifier un Article</a>
        </div>
        <div class="element">
            <a id ="insta" href="https://www.instagram.com/ahmed.dania_/?hl=fr"> Instagram </a>
        </div>
    </nav>
    <h2>Derniers Articles du blog :</h2>
    <?php
            // Connexion à la base de données
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=Blog_php;charset=utf8', 'simoccauch30', 'mamanjetaime4812');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

            // On récupère les 40 derniers Articles
    $req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y\') AS date_creation_fr FROM Articles ORDER BY date_creation DESC LIMIT 0, 40');

    while ($donnees = $req->fetch())
    {
        ?>
        <div class="news">
            <h3>
                <?php 
                // On affiche le titre et la date de l'Article
                echo ($donnees['titre']);?>
                <em>le <?php echo $donnees['date_creation_fr']; ?></em>
            </h3>
            <p>
                <?php
                // On affiche le contenu de l'Article
                echo nl2br ($donnees['contenu']);
                echo "<form method='post' action='ModifierArticles.php' class='deleteform'>
                        <input type='hidden' name='id' value=". $donnees['id'] . ">
                        <input type='submit' name='modifier' class='modifier btn btn-success' value='modifier'>
                    </form>"
                ?>
                <br/>
                <em><a href="Commentaires.php?Articles=<?php echo $donnees['id']; ?>">Commentaires</a></em>
            </p> 
        </div>
        <?php
            } // Fin de la boucle des Articles
            $req->closeCursor();
            ?> 
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        </body>
        </html>