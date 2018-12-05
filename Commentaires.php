<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Commentaires</title>
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
        <a class="lienRetour" href="index.php">Retour au Blog</a>
        <h1 class="titreCom">Ajouter un Commentaire</h1>
    </nav>

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

// Récupération des Articles
    $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM Articles WHERE id = ?');
    $req->execute(array($_GET['Articles']));
    $donnees = $req->fetch();
    ?>

    <div class="news">
        <h3>
            <?php echo htmlspecialchars($donnees['titre']); ?>
            <em>le <?php echo $donnees['date_creation_fr']; ?></em>
        </h3>

        <p>
            <?php
            echo nl2br(htmlspecialchars($donnees['contenu']));
            ?>
        </p>
    </div>
    <?php 
        $req->closeCursor(); //Fin de la boucle recuperation articles
    ?>
    <h2>Commentaires</h2>
    <div id="formulaireCom">
        <form method="POST">
             <div class="element">
                <label>Auteur :</label>
                <input type="text" name="auteur">
            </div><br>
            <div class="element"> 
                <label>Commentaire :</label>
                <textarea type="text" name="commentaire"></textarea>
            </div><br>
            <div class="element">
                <label>date de création :</label>
                <input type="date" name="date_creation">
            </div><br>
            <div class="element">
                <button  class="button" name="submit" type="submit" value="Envoyer">Envoyer</button>
            </div>
        </form>
    </div>
    <?php

// Récupération des commentaires
    $req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_articles ORDER BY date_commentaire');
    $req->execute(array($_POST['Commentaires']));

    while ($donnees = $req->fetch())
    {
        ?>
        <p><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
        <p><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
        <?php
    } // Fin de la boucle des commentaires
    $req->closeCursor();
    ?>
</body>
</html>