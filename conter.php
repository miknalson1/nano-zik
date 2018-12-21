<?php
    header('Access-Control-Allow-Origin:*');
    $nom="Sia ---T-Zik_nano.mp3";
    $zero=0;
    try
    {
       $bdd = new PDO('mysql:host=localhost;dbname=conter','root','');
       
      /* $ins="INSERT INTO files(file_name,downloads)
       VALUES('$nom','$zero')";
       
       $bdd ->exec($ins);*/
       
       echo 'Opération effectuée';
    }
    catch(Exception $e)
    {
       die('Erreur : '.$e->getMessage());
    }

    $filedir = './fichiers/';
   
    $id_fichier = (isset($_GET['f'])) ? trim(intval(sprintf("%d", $_GET['f']))) : 0;
 
    $req_test = $bdd->prepare("SELECT * FROM files WHERE id= :idFichier lIMIT 1");
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
      die('Fichier non trouvé.');


      $req_increment= $bdd->prepare("UPDATE files SET downloads = (downloads+1) WHERE id= :idFichier ");
      $req_increment->execute(array('idFichier' => $id_fichier));

      header("Location: ".$filedir.$fichier['file_name']);
      exit();


?>