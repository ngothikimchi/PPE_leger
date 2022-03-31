<h3> Ajout un citoyen </h3>
<form method="post" action="" enctype="multipart/form-data">
<table>
    <tr>
        <td>Nom : </td>
        <td><input type="text" name="nomCit"
			value="<?php if ($unCitoyen!=NULL) echo $unCitoyen['nomCit']; ?>"></td>
    </tr>
    <tr>
        <td>Prénom : </td>
        <td><input type="text" name="prenomCit"
			value="<?php if ($unCitoyen!=NULL) echo $unCitoyen['prenomCit']; ?>"></td>
    </tr>
    <tr>
        <td>Sexe : </td>
        <td>
        <select name="sexeCit">
            <option value="Masculin" <?php if ($unCitoyen!=NULL && $unCitoyen['sexeCit'] == "Masculin") echo "selected"?> >Masculin</option>
            <option value="Feminin" <?php if ($unCitoyen!=NULL && $unCitoyen['sexeCit'] == "Feminin") echo "selected"?>>Feminin</option>
        </select>
        </td>
    </tr>
    <tr>
        <td>Date de naissance : </td>
        <td><input type="date" name="dateNaissCit"
			value="<?php if ($unCitoyen!=NULL) echo $unCitoyen['dateNaissCit']; ?>"></td>
    </tr>
    <tr>
        <td>Lieu de naissance: </td>
        <td><input type="text" name="lieuNaissCit"
			value="<?php if ($unCitoyen!=NULL) echo $unCitoyen['lieuNaissCit']; ?>"></td>
    </tr>
    <tr>
        <td>Code Postal lieu de naissance: </td>
        <td><input type="text" name="cpLieuNaissCit"
			value="<?php if ($unCitoyen!=NULL) echo $unCitoyen['cpLieuNaissCit']; ?>"></td>
    </tr>
    <tr>
        <td>Adresse:  </td>
        <td><input type="text" name="adresseCit"
			value="<?php if ($unCitoyen!=NULL) echo $unCitoyen['adresseCit']; ?>"></td>
    </tr>

    <tr>
        <td>Ville:  </td>
        <td><input type="text" name="villeCit"
			value="<?php if ($unCitoyen!=NULL) echo $unCitoyen['villeCit']; ?>"></td>
    </tr>
    <tr>
        <td>Code Potsal  </td>
        <td><input type="text" name="cpCit"
			value="<?php if ($unCitoyen!=NULL) echo $unCitoyen['cpCit']; ?>"></td>
    </tr>

    <tr>
        <td>Situation familiale: </td>
        <td>
        <select name="situationFamilialeCit">
            <option value="Célibataire" <?php if ($unCitoyen!=NULL && $unCitoyen['situationFamilialeCit'] == "Célibataire") echo "selected"?> >Célibataire</option>
            <option value="Marié(e)" <?php if ($unCitoyen!=NULL && $unCitoyen['situationFamilialeCit'] == "Marié(e)") echo "selected"?>>Marié(e)</option>
            <option value="Divorcé(e)" <?php if ($unCitoyen!=NULL && $unCitoyen['situationFamilialeCit'] == "Divorcé(e)") echo "selected"?> >Divorcé(e)</option>
            <option value="Pacsé(e)" <?php if ($unCitoyen!=NULL && $unCitoyen['situationFamilialeCit'] == "Pacsé(e)") echo "selected"?>>Pacsé(e)</option>
        </select>
</td>
    </tr>

    <tr>
        <td>Email: </td>
        <td> 
        <?php
            if($unCitoyen==NULL) 
            {?>
                <input type="text" name="emailCit" value="">
            <?php 
            } 
                else echo "Vous ne pouvez changer l'email";   
            ?>
           
        
        </td>
    </tr>

    <tr>
        <td>Mdp</td>
        <td>
            <?php
                if($unCitoyen==NULL) 
                {
                    echo " <input type=\"text\" name=\"mdpUser\"value=\"\" >";
                } 
                else echo "Vous ne pouvez changer mot de passe";   
            ?>
           
        </td>
    </tr>
    <tr>
        <td>Question secrète : </td>
        <td>
        <select name="question">
            <option value="ecoleprimaire" <?php if ($unCitoyen!=NULL && $unCitoyen['question'] == "ecoleprimaire") echo "selected"?> >Ecole primaire</option>
            <option value="persohisto" <?php if ($unCitoyen!=NULL && $unCitoyen['question'] == "persohisto") echo "selected"?>>Personne historique</option>
            <option value="premieramour" <?php if ($unCitoyen!=NULL && $unCitoyen['question'] == "premieramour") echo "selected"?> >Premier amour</option>
            <option value="nommere" <?php if ($unCitoyen!=NULL && $unCitoyen['question'] == "nommere") echo "selected"?>>Nom mère</option>
            <option value="profpref" <?php if ($unCitoyen!=NULL && $unCitoyen['question'] == "profpref") echo "selected"?>>Professeur préféré</option>
        </select>
        </td>
    </tr>
    <tr>
        <td>Réponse : </td>
        <td><input type="text" name="reponse"
			value="<?php if ($unCitoyen!=NULL) echo $unCitoyen['reponse']; ?>"></td>
    </tr>
   
    <tr>
			<td> <input type="reset" name="Annuler" value ="Annuler"> </td>
			<td> <input type="submit" <?php if($unCitoyen!=NULL) echo 'name ="Modifier" 
			value ="Modifier" '; else echo 'name="Valider" value ="Valider"'; ?> > 
		 </td>
		</tr>

    </table>
</form>

<?php
    $unControleur->setTable ("citoyen");   
    if(isset($_POST['Modifier']))
    {   
        $unCitoyen = $unControleur->selectWhere("*", array("idCit"=>$_GET['idCit']));
        $oldEmail = $unCitoyen["emailCit"];

        $where = array("idCit"=>$_GET['idCit']);
		$tab=array(           
            "nomCit"=>$_POST["nomCit"],
            "prenomCit"=>$_POST["prenomCit"], 
            "sexeCit"=>$_POST["sexeCit"], 
            "dateNaissCit"=>$_POST["dateNaissCit"], 
			"lieuNaissCit"=>$_POST["lieuNaissCit"],
            "cpLieuNaissCit"=>$_POST["cpLieuNaissCit"],
            "adresseCit"=>$_POST["adresseCit"], 
            "villeCit"=>$_POST["villeCit"], 
			"cpCit"=>$_POST["cpCit"],
            "situationFamilialeCit"=>$_POST["situationFamilialeCit"],
            "question"=>$_POST["question"],
            "reponse"=>$_POST["reponse"]
			);
		$unControleur->update ($tab, $where); 
        redirect("gestion_citoyen.php");
    }

    if (isset($_POST['Valider']))
    {
        $tab=array(           
            "nomCit"=>$_POST["nomCit"],
            "prenomCit"=>$_POST["prenomCit"], 
            "sexeCit"=>$_POST["sexeCit"], 
            "dateNaissCit"=>$_POST["dateNaissCit"], 
			"lieuNaissCit"=>$_POST["lieuNaissCit"],
            "cpLieuNaissCit"=>$_POST["cpLieuNaissCit"],
            "adresseCit"=>$_POST["adresseCit"], 
            "villeCit"=>$_POST["villeCit"], 
			"cpCit"=>$_POST["cpCit"],
            "situationFamilialeCit"=>$_POST["situationFamilialeCit"],
            "emailCit"=>$_POST["emailCit"],
            "question"=>$_POST["question"],
            "reponse"=>$_POST["reponse"]
			);

		$unControleur->insert ($tab); 
        //insert dans la table user email et mot de passe un citoyen
        $unControleur->setTable("user");
        $tab1 =array(
            "emailUser" =>   $_POST["emailCit"],
            "mdpUser" =>   sha1($_POST["mdpUser"])
        );
        $unControleur->insert ($tab1);
        redirect("gestion_citoyen.php");
    }



    
?>