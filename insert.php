<!-- php : controle des champs et insert -->

<?php

require ('connexion.php');

/* declaration variable php */

$nom = $nom1 = $email = $telephone = "";
$nomError = $nom1Error = $emailError = $telephoneError = "";
$isSuccess = false;

/* controle des champs du formulaire */

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nom = verifyInput($_POST["nom"]);
    $nom1 = verifyInput($_POST["nom1"]);
    $email = verifyInput($_POST["email"]);
    $telephone = verifyInput($_POST["telephone"]);
    $isSuccess = true;
    
    /* controle champs nom */
    
    if(empty($nom))
    {
        $nomError = "Veuillez saisir le nom du client.";
        $isSuccess = false;
    }

    /* controle champs nom2 et vérification que ce soit les mêmes */
    
    if(empty($nom1) || ($_POST['nom'] != $_POST['nom1']))
    {
        $nom1Error = "Veuillez mettre le même nom pour le client.";
        $isSuccess = false;
    }

    /* controle champs email et vérification que c'est bien un email */
    
    if(!isEmail($email))
    {
        $emailError = "Veuillez saisir un e-mail valide.";
        $isSuccess = false;
    }
    
    /* controle champs telephone */
    
    if(!validate_mobile($telephone))
    {
        $telephoneError = "Veuillez saisir un numéro de téléphone valide.";  
        $isSuccess = false;
    } 
    
    /* insert dans la base de donnée */

    if($isSuccess)
    {
        $db = connect();
        $statement = $db->prepare("INSERT INTO clients (nom, email ,telephone) values(?, ?, ?)");
        $statement->execute(array($nom, $email, $telephone));
        $db = disconnect();
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Nouveau client</title>
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
        
        <!-- section home-->
        
        <section id="home">
            <div class="container">
                <div class="row">
        
                    <!-- titre -->
                    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <p class="titre">Nouveau client</p>
                    </div>
        
                    <!-- début formulaire -->
                    
                    <form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                        
                        <!-- nouveau clients -->
                    
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="debutForm">
                                
                                <!-- input nom -->
                                    
                                <label for="nom" class="labelForm1">Nom* :</label><br>
                                <input type="text" id="nom" name="nom" class="formInput" value="<?php echo $nom; ?>">
                                <p style="color:red; font-style:italic;"><?php echo $nomError; ?></p>

                                <!-- input code interne -->
                                
                                <label class="labelForm2">Code interne</label><br>
                                <button class="btn btn-basic">Champs généré automatiquement</button>
                            </div>
                        </div>

                            
                        <!-- contacts -->

                        <div class="col-lg-5 col-lg-offset-1 col-md-12 col-sm-12">
                            <p class="titre2">Contacts</p>
                            
                            <!-- suite du formulaire -->
                            
                            <div class="overlay">

                                <!-- bouton reset -->
                                
                                <button type="reset" class="btnTrash"><span class="glyphicon glyphicon-trash"></span></button><br>
                                
                                <!-- input nom1 -->

                                <label for="nom1" class="labelForm1">Nom contact* :</label>
                                <input type="text" id="nom1" name="nom1" class="formInput2" value="<?php echo $nom1; ?>">
                                <p style="color:red; font-style:italic;"><?php echo $nom1Error; ?></p>
                                

                                <!-- input email -->

                                <label for="email" class="labelForm1">Email :</label>
                                <input type="text" id="email" name="email" class="formInput3" value="<?php echo $email; ?>">
                                <p style="color:red; font-style:italic;"><?php echo $emailError; ?></p>
                                

                                <!-- input telephone -->

                                <label for="nom" class="labelForm1">Téléphone :</label>
                                <input type="text" id="telephone" name="telephone" class="formInput4" value="<?php echo $telephone; ?>">
                                <p style="color:red; font-style:italic;"><?php echo $telephoneError; ?></p>
                                
                            </div>
                            
                            <!-- 1er bouton : ajouter un contact -->                                               
                            
                            <button class="addContact"><span class="glyphicon glyphicon-plus-sign" id="glyph"></span> Ajouter un contact</button><br>

                            <!-- 2eme bouton : sauvegarder -->
                            
                            <button type="submit" id="save">Sauvegarder</button>
                                
                            <!-- message : l'insert est un succès -->
                            
                            <div class="messageSucces">
                                <p class="message" style="display:<?php if($isSuccess) echo 'block'; else echo 'none';?>">Le client a bien été enregistré.</p>
                            </div>
                            
                        </div>                      
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>