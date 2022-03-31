<?php

function ValiderDemandeMono($idDemande)
{
    // echo $idDemande;
    global $unControleur;
    $currentDate = date("Y-m-d H:i:s");
    $where = array("idDemande"=>$idDemande);
    $unControleur->setTable ("demande_mono");
    $tab = array("etat"=>"Demande acceptée"
                ,"dateRep"=>$currentDate
                ,"idEmploye"=>$_SESSION['idEmploye']
    );
    $unControleur->update ($tab, $where);   
}

function RefuserDemandeMono($idDemande)
{
    global $unControleur;
    $currentDate = date("Y-m-d H:i:s");
    $where = array("idDemande"=>$idDemande);
    $unControleur->setTable ("demande_mono");
    $tab = array("etat"=>"Demande refusée",
                "dateRep"=>$currentDate,
                "idEmploye"=>$_SESSION['idEmploye']);
    $unControleur->update ($tab, $where); 
}

function ValiderDemandePluriel($idDemande)
{
    // echo $idDemande;
    global $unControleur;
    $currentDate = date("Y-m-d H:i:s");
    $where = array("idDemande"=>$idDemande);
    $unControleur->setTable ("demande_pluriel");
    $tab = array("etat"=>"Demande acceptée"
                ,"dateRep"=>$currentDate
                ,"idEmploye"=>$_SESSION['idEmploye']
    );
    $unControleur->update ($tab, $where);  
    //changer le status citoyen apres la demande est validé
    //si mariage
    //update citoyen1
    $demande_pluriel= $unControleur->selectWhere("*", $where);
    $idCit1=$demande_pluriel["idCit1"];
    $idCit2=$demande_pluriel["idCit2"]; 
    $type_demande=$demande_pluriel["idTypeDem"]; 
    //dans le cas de mariage
    if($type_demande == 1)
    {
        $unControleur->setTable ("citoyen");
        $where = array("idCit"=>$idCit1);
        $tab = array("situationFamilialeCit"=>"Marié(e)"
    );
        $unControleur->update ($tab, $where);  
    
    //updatecitoyen2    
        $unControleur->setTable ("citoyen");
        $where = array("idCit"=>$idCit2);
        $tab = array("situationFamilialeCit"=>"Marié(e)"
        );
        $unControleur->update ($tab, $where);  
    }
    //dans le cas de divorce
    if($type_demande == 5)
    {
        $unControleur->setTable ("citoyen");
        $where = array("idCit"=>$idCit1);
        $tab = array("situationFamilialeCit"=>"Divorcé(e)"
    );
        $unControleur->update ($tab, $where);  
    
    //updatecitoyen2    
        $unControleur->setTable ("citoyen");
        $where = array("idCit"=>$idCit2);
        $tab = array("situationFamilialeCit"=>"Divorcé(e)"
        );
        $unControleur->update ($tab, $where);  
    }

    //dans le cas de Pacs
    if($type_demande == 4)
    {
        $unControleur->setTable ("citoyen");
        $where = array("idCit"=>$idCit1);
        $tab = array("situationFamilialeCit"=>"Pacsé(e)"
    );
        $unControleur->update ($tab, $where);  
    
    //updatecitoyen2    
        $unControleur->setTable ("citoyen");
        $where = array("idCit"=>$idCit2);
        $tab = array("situationFamilialeCit"=>"Pacsé(e)"
        );
        $unControleur->update ($tab, $where);  
    }   
}

function RefuserDemandePluriel($idDemande)
{
    global $unControleur;
    $currentDate = date("Y-m-d H:i:s");
    $where = array("idDemande"=>$idDemande);
    $unControleur->setTable ("demande_pluriel");
    $tab = array("etat"=>"Demande refusée",
                "dateRep"=>$currentDate,
                "idEmploye"=>$_SESSION['idEmploye']);
    $unControleur->update ($tab, $where); 
    
}

function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}
//$length=5 par defaut length =5 
function generateRandomReference($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function EstAdmin()
{
    if(isset($_SESSION['role']) && $_SESSION['role'] == '2')
        return true;
    else
        return false;
}

function EstConnecte()
{
    if(isset($_SESSION['email']))
        return true;
    else
        return false;
}

function EstCitoyen()
{
    if(isset($_SESSION['idCit']))
        return true;
    else
        return false;
}

?>