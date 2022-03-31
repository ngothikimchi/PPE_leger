<?php
    require_once("header.php");
    $unControleur->setTable ("evenement");
    $uneEv = null;

    if (isset($_GET['idEve']) && isset($_GET['action']))
	{
		$action = $_GET['action']; 
		$id_eve = $_GET['idEve'];
		$where = array("idEve"=>$id_eve);
		switch ($action) {
			case 'sup':
			 	$unControleur->delete($where);
				break;
			
			case 'edit':
				$uneEv = $unControleur->selectWhere("*", $where);
				break;
		}
	}



    require_once("vue/vue_insert_evenement.php"); 
    require_once("vue/vue_gestion_evenements.php"); 
	require_once("vue/vue_gestion_participer.php"); 
    require_once("footer.php"); 

?>