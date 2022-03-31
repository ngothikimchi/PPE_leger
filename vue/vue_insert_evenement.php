<h3 class="titre_page_admin"> Ajout d'un événément </h3>
<form method="post" action="" enctype="multipart/form-data">
<table class="style_table_inscrire">
    <tr class="style_line">
        <td>Nom d'événément: </td>
        <td><input type="text" name="nomEve"
			value="<?php if ($uneEv!=NULL) echo $uneEv['nomEve']; ?>"></td>
    </tr>
    <tr class="style_line">
        <td>Le contenu: </td>
        <td><input type="text" name="contenuEve"
			value="<?php if ($uneEv!=NULL) echo $uneEv['contenuEve']; ?>"></td>
    </tr>
    <tr class="style_line">
        <td>Adresse: </td>
        <td><input type="text" name="adresseEve"
			value="<?php if ($uneEv!=NULL) echo $uneEv['adresseEve']; ?>"></td>
    </tr>
    <tr class="style_line">
        <td>Date début d'événément: </td>
        <td><input type="date" name="debutEve"
			value="<?php if ($uneEv!=NULL) echo $uneEv['debutEve']; ?>"></td>
    </tr>
    <tr class="style_line">
        <td>Date fin d'événément: </td>
        <td><input type="date" name="finEve"
			value="<?php if ($uneEv!=NULL) echo $uneEv['finEve']; ?>"></td>
    </tr>
    <tr class="style_line">
        <td>Date fin d'inscription: </td>
        <td><input type="date" name="dateFinInscriptionEve"
			value="<?php if ($uneEv!=NULL) echo $uneEv['dateFinInscriptionEve']; ?>"></td>
    </tr>
    <tr class="style_line">
        <td>Le nombre participant maximamum: </td>
        <td>
        <?php
            if($uneEv==NULL)
            {
        ?>
            <input type="text" name="nbParticipantMaxEve"
			value="">
        <?php
          
            }
            else
            {
                echo "Vous ne pouvez pas modifier le nbr participant maximum!";
            }
        ?>
        </td>
    </tr>
    
    
    <tr class="style_line">
        <td>Type evenement:</td>
        <td><select name="codeTypeEve">
            <?php
                $unControleur->setTable ("type_evenement");
                $chaine="*";
                $lesTypeEves=$unControleur->selectAll($chaine); 
                foreach ($lesTypeEves as $uneTypeEve)
                {
                    echo "<option value='".$uneTypeEve['codeTypeEve']."'>".$uneTypeEve['codeTypeEve']."</option>";
                }
            ?>
        </select>
        </td>
    </tr>

    <tr class="style_line">
        <td>Association: </td>
        <td><select name="idAssocEve">
            <?php
                $unControleur->setTable ("association");
                $chaine="*";
                $lesAssos=$unControleur->selectAll($chaine); 
                foreach ($lesAssos as $uneAssoc)
                {
                    echo "<option value='".$uneAssoc['idAssoc']."'>".$uneAssoc['nomAssoc']."</option>";
                }
            ?>
        </select>
        </td>
        
    </tr>
    <tr class="style_line">
			<td > <input style="width:50%;margin-left:20px;" type="reset" name="Annuler" value ="Annuler"> </td>
			<td > <input style="width:50%;margin-left:40px;" type="submit" <?php if($uneEv!=NULL) echo 'name ="Modifier" 
			value ="Modifier" '; else echo 'name="Valider" value ="Valider"'; ?> > 
		 </td>
		</tr>

    </table>
</form>
    
<?php
    $unControleur->setTable ("evenement");   

    


    if(isset($_POST['Modifier']))
    {   
        $where = array("idEve"=>$_GET['idEve']);
		$tab=array(            
            "nomEve"=>$_POST["nomEve"],
            "contenuEve"=>$_POST["contenuEve"], 
			"adresseEve"=>$_POST["adresseEve"],
            "debutEve"=>$_POST["debutEve"], 
            "finEve"=>$_POST["finEve"], 
            "dateFinInscriptionEve"=>$_POST["dateFinInscriptionEve"], 
          
            "codeTypeEve"=>$_POST["codeTypeEve"],
			"idAssocEve"=>$_POST["idAssocEve"]);
		$unControleur->update ($tab, $where); 
		// header("Location: index.php?page=2"); 
    }

    if (isset($_POST['Valider']))
    {
        echo "tata";
        $tab = array(           
            "nomEve"=>$_POST["nomEve"],
            "contenuEve"=>$_POST["contenuEve"], 
			"adresseEve"=>$_POST["adresseEve"],
            "debutEve"=>$_POST["debutEve"], 
            "finEve"=>$_POST["finEve"], 
            "dateFinInscriptionEve"=>$_POST["dateFinInscriptionEve"], 
            "nbParticipantMaxEve"=>$_POST["nbParticipantMaxEve"],
            "codeTypeEve"=>$_POST["codeTypeEve"],
			"idAssocEve"=>$_POST["idAssocEve"]
           
       );

		$unControleur->insert ($tab); 
    }

?>
