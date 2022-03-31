<?php	
	require_once("header.php");
	
	if (isset($_GET['page'])) 
	{
		$page = $_GET['page'];
		switch($page)
		{
			//ma mairie
			case "culture" : require_once("vue/vue_culture.php"); 	
					 break;
			case "rond" : require_once("vue/rond_ermont.php"); 	
					 break;
			case "kiosque" : require_once("vue/kiosque.php"); 	
					 break;
			case "durable" : require_once("vue/durable.php"); 	
					 break;
			case "jeuness" : require_once("vue/jeuness.php"); 	
					 break;
			case "connexion" : require_once("vue/vue_connexion.php"); 	
					 break;	
			 case "inscrire" : require_once("vue/vue_inscrire.php"); 	
					 break;	
			
					 
				 
			case "deconnexion" : 
				unset($_SESSION);
				session_destroy();
				redirect('index.php');
				break;
			default : 
				require_once("home.php"); 
		}
	}
	else
		require_once("home.php");

	require_once("footer.php"); 
?>