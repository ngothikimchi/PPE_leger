<h3 class="titre_page_admin"> Ajout un type événement d'adulte </h3>
<form method="post" action="" enctype="multipart/form-data">
<table class="style_table_inscrire">
    <tr class="style_line">
        <td>Code Type événement : </td>
        <td><input type="text" name="codeTypeEve"
			value="<?php if ($unTypeEveAdulte!=NULL) echo $unTypeEveAdulte['codeTypeEve']; ?>"></td>
    </tr>

    <tr class="style_line">
        <td>Nom de type événement : </td>
        <td><input type="text" name="nomTypeEve"
			value="<?php if ($unTypeEveAdulte!=NULL) echo $unTypeEveAdulte['nomTypeEve']; ?>"></td>
    </tr>

   
    <tr class="style_line">
        <td> <input style="width:50%;margin-left:20px;" type="reset" name="Annuler" value ="Annuler"> </td>
        <td> <input style="width:50%;margin-left:40px;" type="submit" <?php if($unTypeEveAdulte!=NULL) echo 'name ="Modifier1" 
        value ="Modifier" '; else echo 'name="Valider1" value ="Valider"'; ?> > 
		 </td>
	</tr>

    </table>
</form>

<?php
    $unControleur->setTable ("type_evenement_adulte");   
    if(isset($_POST['Modifier1']))
    {   
        $where = array("codeTypeEve"=>$_GET['codeTypeEve']);
		$tab=array(
           "nomTypeEve"=>$_POST["nomTypeEve"]
			);
		$unControleur->update ($tab, $where); 
		redirect("gestion_all_type_Eve.php");
    }

    if (isset($_POST['Valider1']))
    {

        $tab=array(
            "codeTypeEve"=>$_POST["codeTypeEve"],
            "nomTypeEve"=>$_POST["nomTypeEve"] 
			);

		$unControleur->insert ($tab); 
        redirect("gestion_all_type_Eve.php");
    }
?>