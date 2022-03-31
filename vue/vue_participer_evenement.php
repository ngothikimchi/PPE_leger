<?php
    //vérifier si un citoyen est en cours de connecter
    if(!EstCitoyen())
    {
        echo "<div class='notification'>Merci de se connecter pour participer aux événements</div>";
        return;
    }

    
    //check ce citoyen a déjà inscrit à cet événement --à faire
    $idEve=$_GET["idEve"];
    $chaine="*";
    $idCitoyen=$_SESSION['idCit'];
    $where=array("idEve"=>$idEve,
        "idCit"=>$idCitoyen);
    $unControleur->setTable ("participer");
    $unEveCitoyenA=$unControleur->selectWhere($chaine,$where);
    if(isset($unEveCitoyenA["idEve"]) && isset($unEveCitoyenA["idCit"]))
    {
        echo "<div class='notification'>Vous avez déjà inscrit sur cet événement</div>";
        return;
    }
    //check if cet evenement est sur type enfant
    
    $chaine="*";
    $where=array("idEve"=>$idEve);
    $unControleur->setTable("evenement_enfant_view");
    $unEveEnfant=$unControleur->selectWhere($chaine,$where);

    //pour adulte
    if(!isset($unEveEnfant["idEve"]))
    {    
        //echo "ad";
        $datenaissance=$_SESSION['dateNaissCit'];
        $datenaissance_convertir=new DateTime($datenaissance);
        $currentDate = new DateTime();
        $interval = $currentDate->diff($datenaissance_convertir);
        //prendre annee par"y"
        if($interval->y < 18)
        {
            echo "<div class='notification'>Vous devez etre plus de 18 ans pour participer ces événements</div> ";
            return;
        }

        //  insérer dans la table participer
        $unControleur->setTable ("participer");
        $currentDate = date("Y-m-d H:i:s");
        $tab=array(
            "idEve"=>$_GET["idEve"],
            "idCit"=>$_SESSION['idCit'],
            "dateDemande"=>$currentDate
        );
		$unControleur->insert($tab);   
        echo "<div class='notification'>Votre demande a été envoyée </div>";       
        return;
    }
    //pour enfant    
    //echo "enfant";    
    if($unEveEnfant["accompagnant"]==1)
    {
        echo "<div class='notification'>Remark: accompagnement d'enfants est obligatoire </br></div>";
    }

    $datenaissance=$_SESSION['dateNaissCit'];
    //check si ce citoyen a déja inscrit pour participer a cette evenement
    $datenaissance_convertir=new DateTime($datenaissance);
    $currentDate = new DateTime();
    $interval = $currentDate->diff($datenaissance_convertir);
    if($interval->y <= $unEveEnfant["trancheAgeMin"] ||
    $interval->y >= $unEveEnfant["trancheAgeMax"])
    {
        echo "<div class='notification'>Votre age n'est pas valide pour cet évenement </div>";
        return;
    }
    $unControleur->setTable ("participer");
    $currentDate = date("Y-m-d H:i:s");
    $tab=array(
        "idEve"=>$_GET["idEve"],
        "idCit"=>$_SESSION['idCit'],
        "dateDemande"=>$currentDate
    );
    
    $unControleur->insert($tab); 
    echo "<div class='notification'>Votre demande a été envoyée</div>";
?>
