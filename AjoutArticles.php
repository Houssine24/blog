<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ajout Article Blog</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
            <a class="lienRetour" href="index.php">Retour au Blog</a>
            <h1>Ajouter</h1>
            <a class="lienModif" href="ModifierArticles.php">Modifier un Article</a>
    </nav>

    <div id="formulaireAjout">
        <form enctype="multipart/form-data" method="POST" ACTION="">
            <div class="element">
                <label>Titre :</label>
                <input type="text" name="titre">
            </div><br>
            <div class="element"> 
                <label>Article :</label>
                <textarea type="text" name="contenu"></textarea>
            </div><br>
            <div class="element">
                <label>date de création :</label>
                <input type="date" name="date_creation">
            </div><br>
            <div class="element">
                <input type="hidden" name="MAX_FILE_SIZE" value="250000" />
                <input type="file" name="fic" size=50 />
            </div><br>
            <div class="element">
                <button  class="button" name="submit" type="submit" value="Envoyer">Envoyer</button>
            </div>
        </form><br>
        <p><a href="liste.php">Liste Images.</a></p>
    </div>   
<?php
//Message d'erreur si input vide.
if(!empty($_POST['submit'])){
    if (!empty($_POST['titre']) && !empty($_POST['contenu']) && !empty($_POST['date_creation'])){
        try {
            //Pour éviter les erreur.
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            // Connexion à la base de données.
            $bdd = new PDO('mysql:host=localhost;dbname=Blog_php;charset=utf8', 'simoccauch30','mamanjetaime4812', $pdo_options);
            //Ajout du nouvel article dans la base de donnée.
            $req = $bdd->prepare('INSERT INTO Articles(titre, contenu, date_creation)
                VALUES(:titre, :contenu, :date_creation)');
            $req->execute(array(
                ':titre' => $_POST['titre'],
                ':contenu' => $_POST['contenu'],
                ':date_creation' => $_POST['date_creation']
            ));
            header('Location: index.php');
        }
        catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
            }
    }else{
        echo  "<script>alert( 'erreur de saisie');</script>"; 
    }
}
?>
       
<?php
include ("transfert.php");
    if ( isset($_FILES['fic']) )
        {
            transfert();
        }
?>
</body>
</html>