<!DOCTYPE html>
<html>
    <head>
        <title>Clients</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    
        <!-- header : navbar -->
        
        <?php 
        
        require ('header.php');
        
        ?>
        
        <!-- section view -->
        
        <section id="view">
            <div class="container">
                <div class="row">
        
                    <!-- titre -->
                    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p class="titre">Liste des clients</p>
                    </div>

                    <!-- création du tableau -->

                    <table class="table table-bordered">

                    <!-- création colonnes--> 

                        <tr class="titreTableau">
                            <th>Code interne</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>

                        <!-- début php -> select -->

                        <?php

                        require 'connexion.php';

                        $db = connect();

                        $statement = $db -> query("SELECT * FROM clients");

                        while ($row = $statement -> fetch()) 
                        {

                            echo"<div class='col-lg-12 col-md-12 col-sm-12'>
                                <tr class='contenuTableau'>
                                    <td>".$row['id_client']."</td>
                                    <td>".$row['nom']."</td>
                                    <td>".$row['email']."</td>
                                    <td>".$row['telephone']."</td>                           
                                    <td><a href='update.php?id=".$row['id_client']."' role='button'>Modifier</a></td>
                                    <td><a href='delete.php?id=".$row['id_client']."' role='button'>Supprimer</a></td>
                                </tr>
                            </div>";    

                        ?>

                        <!-- fermeture de la boucle -->

                        <?php

                        }

                        disconnect()

                        ?>

                    <!-- fermeture tableau -->

                    </table>
                    
                    <!-- bouton ajouter un client -->
                    
                    <a href= "insert.php" role='button' class="addClient">Ajouter un client</a>
                </div>
            </div>
        </section>
    </body>
</html>