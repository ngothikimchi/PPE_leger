<?php
	require_once(__DIR__."controleur/controleur.class.php"); 
	require_once(__DIR__."controleur/config_db.php"); 
	//instanciation de la classe Controleur
    $unControleur = new Controleur($serveur, $bdd, $user, $mdp);
?>

<?php

    function InscrireUtilisateur($identifiant, $mdp)
    {
       //on demande donc si les champs sont défini avec "isset"
       if(empty($identifiant)){//le champ pseudo est vide, on arrête l'exécution du script et on affiche un message d'erreur
            echo "Le champ idenfiant est vide.";
            return false;
        }
        
        if(!preg_match("#^[a-z0-9]+$#",$identifiant)){//le champ pseudo 
            //est renseigné mais ne convient pas au format qu'on souhaite qu'il soit, soit: que des lettres minuscule + 
            //des chiffres (je préfère personnellement enregistrer le pseudo de mes membres en minuscule afin de ne pas avoir 
            //deux pseudo identique mais différents comme par exemple: Admin et admin)
            echo "Le champ identifiant doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
            return false;
        } 
        
        
        if(strlen($identifiant)>25){//le pseudo est trop long, il dépasse 25 caractères
            echo "Le champ identifiant est trop long, il dépasse 25 caractères.";
            return false;
        } 
        
        if(empty($mdp)){//le champ mot de passe est vide
            echo "Le champ Mot de passe est vide.";
            return false;
        } 

        global $unControleur;
        $chaine ="*"; 
        $where = array("identifiant"=>$identifiant);
        $unControleur->setTable ("user"); 
        $unUser = $unControleur->selectWhere($chaine, $where); 

        if(isset($unUser['identifiant']))
        {
            echo "Ce identifiant est déjà utilisé.";
            return false;
        }

        //toutes les vérifications sont faites, on passe à l'enregistrement dans la base de données:
        //Bien évidement il s'agit là d'un script simplifié au maximum, libre à vous de rajouter des conditions 
        //avant l'enregistrement comme la longueur minimum du mot de passe par exemple

        $tab = array("identifiant"=>$identifiant,
                    "mdp"=>$mdp);
        $unControleur->insert ($tab); 

        echo "Vous êtes inscrit avec succès!";
        
        return false;
    }

    if(!isset($_POST['identifiant'], $_POST['mdp']))
        $inscrireSucces = false;
    else
        $inscrireSucces = InscrireUtilisateur($_POST['identifiant'], $_POST['mdp']);
    
    //traitement du formulaire:
    if($inscrireSucces == false){
        ?>
        <!-- 
        Les balises <form> sert à dire que c'est un formulaire
        on lui demande de faire fonctionner la page inscription.php une fois le bouton "S'inscrire" cliqué
        on lui dit également que c'est un formulaire de type "POST"
         
        Les balises <input> sont les champs de formulaire
        type="text" sera du texte
        type="password" sera des petits points noir (texte caché)
        type="submit" sera un bouton pour valider le formulaire
        name="nom de l'input" sert à le reconnaitre une fois le bouton submit cliqué, pour le code PHP
         -->
        <br />
        <form method="post" >
            Identifiant (a-z0-9) : <input type="text" name="identifiant">
            <br />
            Mot de passe : <input type="password" name="mdp">
            <br />
            <input type="submit" value="S'inscrire">
        </form>
        <?php
    }
    
    
?>