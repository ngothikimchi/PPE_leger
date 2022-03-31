
<?php	
	require_once("header.php");
    $unControleur->setTable ("evenement");
    
	if (isset($_GET['idEve'])) 
    	require_once("vue/vue_participer_evenement.php");
	else
		require_once("vue/vue_all_evenement.php");

	require_once("footer.php"); 
?>


</center>
</body>
</html>