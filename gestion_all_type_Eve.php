<?php
    require_once("header.php");
    if(!isset($_SESSION['role']) || $_SESSION['role'] != '2')
    {
        require_once("vue/vue_connexion.php");     
        return;
    }

    $unControleur->setTable ("type_evenement_enfant");
    $unTypeEveEnfant=null;    
    $unTypeEveAdulte=null;
    $lesTypeEveEnfant = $unControleur->selectAll();
    
    if (isset($_GET['action']) && isset($_GET['codeTypeEve']))
    {   
        $estTypeEnfant = false;
        foreach($lesTypeEveEnfant as $unTypeEnfant) 
        {
            if(isset($_GET['codeTypeEve']) && $unTypeEnfant["codeTypeEve"] == $_GET['codeTypeEve'])
            {
                $estTypeEnfant = true;
                break;
            }
        }

        if($estTypeEnfant)
        {
            $action = $_GET['action'];
            $codeTypeEveEnfant = $_GET['codeTypeEve'];
            $where = array("codeTypeEve"=>$codeTypeEveEnfant);

            switch ($action) {
                case 'supprimer':
                    $unControleur->delete($where);
                    redirect("gestion_all_type_Eve.php");
                    break;
                
                case 'modifier':
                    $unTypeEveEnfant = $unControleur->selectWhere("*", $where);
                    break;
            }
        }
        else
        {
            $unControleur->setTable ("type_evenement_adulte");
            $lesTypeEveAdulte = $unControleur->selectAll();
            
            $action = $_GET['action'];
            $codeTypeEveAdulte = $_GET['codeTypeEve'];
            $where = array("codeTypeEve"=>$codeTypeEveAdulte);

            switch ($action) {
                case 'supprimer':
                    $unControleur->delete($where);
                    redirect("gestion_all_type_Eve.php");
                    break;
                
                case 'modifier':
                    $unTypeEveAdulte = $unControleur->selectWhere("*", $where);
                    print_r($unTypeEveAdulte);
                    break;
            }
        
        }

    }

    require_once("vue/vue_insert_typeEveEnfant.php"); 
    require_once("vue/vue_all_typeEveEnfants.php");

    $unControleur->setTable ("type_evenement_adulte");
    $lesTypeEveAdulte = $unControleur->selectAll();

    require_once("vue/vue_insert_typeEveAdulte.php"); 
    require_once("vue/vue_all_typeEveAdultes.php");
?>

<?php
require_once("footer.php");
?>