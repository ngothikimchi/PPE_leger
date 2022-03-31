<?php
    require_once("header.php");   

    require_once("vue/vue_all_demandes_mono.php");
    if (isset($_GET['action']) && isset($_GET['idDemande'])) 
		{
			$action = $_GET['action'];
			$idDemande = $_GET['idDemande'];

			if($action == 'valider')
				ValiderDemandeMono($idDemande);
			if($action == 'refuser')
				RefuserDemandeMono($idDemande);
        }

?>
<?php
require_once("footer.php");
?>
