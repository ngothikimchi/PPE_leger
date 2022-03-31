<?php
    require_once("header.php");
    $unControleur->setTable ("citoyen");
    $lesCitoyens = $unControleur->selectAll();
    if(!isset($_SESSION['role']) || $_SESSION['role'] != '2')
    {
        require_once("vue/vue_connexion.php");     
        return;
    }

    $unCitoyen=null;
    
    if (isset($_GET['action']) && isset($_GET['idCit'])) 
    {
        $action = $_GET['action'];
        $idCitoyen = $_GET['idCit'];
        $where = array("idCit"=>$idCitoyen);

        switch ($action) {
            case 'supprimer':
                $unControleur->delete($where);
                redirect("gestion_citoyen.php");
                break;
            
            case 'modifier':
                $unCitoyen = $unControleur->selectWhere("*", $where);
                break;
        }
    }

    require_once("vue/vue_insert_citoyen.php"); 
    require_once("vue/vue_all_citoyens.php");
  
?>
<?php
require_once("footer.php");
?>