<!DOCTYPE html>
<html >
<head lang="en">
	<title>Site de la mairie </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<script src="./js/jquery-3.2.1.min.js"></script>
	<script src="./js/popper.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="https://kit.fontawesome.com/f1f264d28e.js" crossorigin="anonymous"></script>
</head>
<body>
<center>
		
<?php	
	require_once("header.php");
	
    if (isset($_GET['page'])) 
        {
            $page = $_GET['page'];
            switch($page){
                case "rond_ermont" : 
                    require_once("vue/rond_ermont.php"); 	
                    break;  
                   
                default : require_once("erreur.php"); 	
                        break;
                }
        }
        
 ?>
<?php
require_once("footer.php"); 
   
?>
	
</center>
</body>
</html>






