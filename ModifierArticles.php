<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Modif Article Blog</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
    <h1>Modifier un Article</h1>
    <a href="index.php"><p> Retour au Blog.</p></a>
</body>
</html>
<?php

ini_set('display_errors', 1);
try
{

    $bdd = new PDO('mysql:host=localhost;dbname=Blog_php;charset=utf8','simoccauch30', 'mamanjetaime4812');
}
catch (Exception $e){

    die('Erreur : ' . $e->getMessage());
};

if(isset($_POST['modifier']))
{
    $id_modif = $_POST['id'];
    $req =$bdd->query("SELECT * WHERE id=" . $id_modif);
    while ($donnees = $req->fetch())
    {
        echo    "<div style='margin-top: 5%;'>
                    <form method='post'>
                        <tr><td><input type='hidden' name='id' value=". $donnees['id'] . "></tr></td>
                        <tr><td><input name='titre'>" . $donnees['titre'] . "</input></td>
                        <td><textarea name='contenu'>" . $donnees['contenu'] . "</textarea></td>
                        <td><input type='date' name='date_creation' value=" . $donnees['date_creation'] . "></td>
                        <td><button  class='button' name='submit' type='submit' value='Envoyer'>Envoyer</button></td>
                    </form>
                </div>";    
    };      
}

if(isset($_POST['submit']))
{     
    $id_modif = $_POST['id'];
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $date = $_POST['date_creation'];
    $bdd->query("UPDATE * SET 
        titre = '".$titre."',
        contenu = '".$contenu."',
        date_creation = '".$date."' WHERE id = " . $id_modif);
    header('Location: index.php');
}
?>
