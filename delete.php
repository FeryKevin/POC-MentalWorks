<?php

require 'connexion.php';

$id = "";

if(!empty($_GET['id'])) 
{
    $id = verifyInput($_GET['id']);
}

/* requete delete */

if(!empty($_POST['id'])) 
{
    $id = verifyInput($_POST['id']);

    $db = connect();

    $sql = "DELETE FROM clients WHERE id_client = ?";
    $statement= $db->prepare($sql);
    $statement->execute(array($id));

    disconnect();

    header("Location: index.php"); 
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Suppression d'un client</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        
        <!-- section delete -->
        
        <section id="delete">
             <div class="container">
                <div class="row">

                    <!-- titre section -->

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p class="titre">Supprimer un client</p>
                    </div>

                    <!-- formulaire suppression projet -->

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form class="form" action="delete.php" role="form" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id;?>"/>
                            <p class="alert alert-danger">Êtes-vous sur de vouloir supprimer le client ?</p>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-danger">Oui</button>
                                <a class="btn btn-default" href="index.php">Non</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>