	
    <?php	
        require_once("header.php");

        if (isset($_GET['page'])) 
        {
            $page = $_GET['page'];
            switch($page){
                case "durable" : require_once("vue/durable.php"); 	
                    break;  
                case "stationnement" : require_once("vue/stationnement.php"); 	
                    break;  
                case "elus" : require_once("vue/elus.php"); 	
                    break;
                case "securite" : require_once("vue/securite.php"); 	
                    break;
  
                default : require_once("erreur.php"); 	
                        break;
                }
        }
        
    ?>



<!-- switch to require_once("some page here"); vi du : savoir, activité,.... -->

    <?php
		require_once("footer.php"); 
	?>