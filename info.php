
    <?php	
        require_once("header.php");

        if (isset($_GET['page'])) 
        {
            $page = $_GET['page'];
            switch($page){
                case "savoir" : require_once("vue/vue_savoir.php"); 	
                    break;  
                case "solidarite" : require_once("vue/vue_solidarite.php"); 	
                 break;      
                case "education" :require_once("vue/vue_education.php"); 
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




