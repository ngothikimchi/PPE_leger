<?php
	session_start();
	require_once("controleur/controleur.class.php"); 
	require_once("controleur/config_db.php"); 
  require_once("controleur/function.php");
	//instanciation de la classe Controleur
	$unControleur = new Controleur($serveur, $bdd, $user, $mdp);
?>

<!DOCTYPE html>
<html >
<head lang="en">
	<title>Site de la mairie </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<script src="./js/jquery-3.2.1.min.js"></script>
	<script src="./js/popper.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/f1f264d28e.js" crossorigin="anonymous"></script>
</head>
<body>
<center>



<!-- ajouter bootstrap -->
<nav class="navbar navbar-expand-lg navbar-light bg-light bar_menu">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">      
      <a class="nav-link" href="index.php?page=home">
        <img class="img_header" src="images/logo_ville_ermont.jpg" width="170" height="50">        
      </a>
      </li>
      
      <li class="nav-item dropdown underline">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Ermont & Vous
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="info.php?page=savoir">Tout savoir sur Ermont</a>
          <a class="dropdown-item" href="info.php?page=solidarite">Solidarité</a>
          <a class="dropdown-item" href="info.php?page=education">Education</a>
          <div class="dropdown-divider"></div>   
        </div>
      </li>

	  

	  <li class="nav-item dropdown underline">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Vie municipale
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="municipal.php?page=durable">Développement durable</a>
          <a class="dropdown-item" href="municipal.php?page=elus">Les élus</a>
          <a class="dropdown-item" href="municipal.php?page=stationnement">Stationnement et transports</a>
          <a class="dropdown-item" href="municipal.php?page=securite">Sécurité, prévention et police municipale</a>
          <div class="dropdown-divider"></div>
          
        </div>
      </li>

	  

	 
      <li class="nav-item underline">
        <a class="nav-link" href="evenement.php">Événement</a>
      </li>

     
	  <!-- <li class="nav-item dropdown underline">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Service
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="service.php?code=acte_naissance">Demande d'acte de naissance</a>
          <a class="dropdown-item" href="service.php?code=carte_nationale">Demande Carte Nationale d'Identité</a>
          <a class="dropdown-item" href="service.php?code=passport">Demande de passeport</a>
          <a class="dropdown-item" href="service.php?code=mariage">Demande d'acte de mariage</a>
          <a class="dropdown-item" href="service.php?code=pacs">Pacte civile de solidarité</a>
          <div class="dropdown-divider"></div>
          
        </div>
      </li> -->

      <li class="nav-item">
          <a class="nav-link" href="index.php?page=inscrire">Inscrire</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="service_administration.php">Service en ligne</a>
        </li>

        <!-- que admin peut accéder les parties de gestions de demande et gestion des evenement -->
        <?php
        if(EstAdmin())
        {
      ?>      
        <li class="nav-item dropdown underline">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	Gestion d'administration
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="gestion_citoyen.php">Gestion des citoyens</a>
          <a class="dropdown-item" href="gestion_demande_mono.php">Gestion des demandes mono</a>
          <a class="dropdown-item" href="gestion_demande_pluriel.php">Gestion des demandes pluriel</a>       
          <a class="dropdown-item" href="gestion_all_type_Eve.php">Gestion type des événements</a>
          <a class="dropdown-item" href="gestion_evenement.php">Gestion des événements</a>  
          <div class="dropdown-divider"></div>   
        </div>
      </li>

      <?php
        }
      ?>    
        
      
    <!-- que admin peut accéder les parties de gestions de demande et gestion des evenement -->
      <!-- <?php
        //if(EstAdmin())
        {
      ?>      
         <li class="nav-item">
          <a class="nav-link" href="gestion_citoyen.php">Gestion des citoyens</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gestion_demande_pluriel.php">Gestion des demandes pluriel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gestion_demande_mono.php">Gestion des demandes mono</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gestion_evenement.php">Gestion des événements</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="gestion_all_type_Eve.php">Gestion type des événements</a>
        </li>

      <?php
        }
      ?>     -->



      <!-- par defaut cest connexion , apres connexion il affiche onglet deconnexion pour sortir la section -->
	    <li class="nav-item">
        <?php
          if(EstConnecte())
          {
        ?>      
          <a class="nav-link" href="index.php?page=deconnexion"><img style="width:20px;" src="images/deconnexion.jpg"></a>
        <?php
          }
          else
          {
        ?>
          <a class="nav-link" href="index.php?page=connexion">Connexion</a>
        <?php
          }
        ?>
      </li>
    </ul>

  </div>
</nav>