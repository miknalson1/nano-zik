<?php 
        header('Access-Control-Allow-Origin:*');
        try
        {
           $bdd = new PDO('mysql:host=localhost;dbname=conter','root','');
        }
        catch(Exception $e)
        {
           die('Erreur : '.$e->getMessage());
        }

        function afficherNombreDeTelechargements($id_fichier){
            global $bdd;
            $req_test = $bdd->prepare("SELECT * FROM files WHERE id= :idFichier LIMIT 1");
            $req_test->execute(array('idFichier' => $id_fichier));

            $fichier_existe = false; $fichier = array();
            while($test = $req_test->fetch()){
                if((isset($test['file_name'])) && ($test['file_name'] != '')){
                    $fichier_existe = true;
                    $fichier = $test;
                    break;
                }
            }
            $req_test->closeCursor();
            if($fichier_existe == false)
                return array();
            else
                return $fichier;    
        };

?>

<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <title>T-Zik_nano</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="description" content="T-zik_nano">
            <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <!--En tête-->
        <?php
            include("forme/tete.php");
        ?>
        <!--menu-->
        <?php
            include("forme/Menu.php");
        ?>
        <!--fin menu-->
        
        <!-- Début -->
        <section class="jaune">
            <h1>Sia !</h1>
            <div class="sec">
                <div class="left">
                    <?php $f14= afficherNombreDeTelechargements(14); ?>
                     <p><a href="conter.php?f=14"><img title="télécharger" src="doc/img/ipdf.png" alt="Sia" width="200px" height="200px" ></a><br>
                    <?php echo $f14['downloads'].' téléchargements'?></p>
                </div>
                <div class="right">
                    <p>Le new singel de sia</p>
                    <p>Titre : <strong>My life</strong></p>
                    <p><strong>N'hésitez pas à cliquez sur l'image pour lancer le téléchargement</strong></p><br>
                </div>
                <audio controls="controls" loop="loop">
                        <source src="fichiers/Sia ---T-Zik_nano.mp3"></source>
                </audio>
            </div>
        </section>
        <!-- Fin -->
        
        <section class="verte">
            <h1>Damso</h1>
            <div class="sec">
                <div class="left">
                    <?php $f13= afficherNombreDeTelechargements(13); ?>
                     <p><a href="conter.php?f=13"><img title="télécharger" src="doc/img/ipdf.png" alt="Sia" width="200px" height="200px" ></a><br>
                    <?php echo $f13['downloads'].' téléchargements'?></p>
                </div>
                <div class="right">
                    <div class="right">
                    <p>Le new singel de Damso</p>
                    <p>Titre : <strong>debroullard</strong></p>
                    <p><strong>N'hésitez pas à cliquez sur l'image pour lancer le téléchargement</strong></p><br>
                </div>
                    <audio controls="controls" loop="loop">
                        <source src="fichiers/Damso-debrouillard---T-Zik_nano.mp3"></source>
                    </audio>
                </div>
            </div>
        </section>
        
        <!--pied-->
        <?php
            include("forme/Pied.php");
        ?>
    </body>
</html>