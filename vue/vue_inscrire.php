
<div class="formulaire_saisir_info">
    <h2 class="titre_page_admin" style="color:white;font-weight:bolder;">S'inscrire au site de la mairie d'Ermont</h2>
    <div class="padding_table">
    <form method="post" action="">
    <table class="style_table_inscrire">
        <tr class="style_line">
            <td>Nom</td>
            <td><input type="text" name="nomCit" required="required"></td>
        </tr>
        <tr class="style_line">
            <td>Prénom</td>
            <td><input type="text" name="prenomCit" required="required"></td>
        </tr>

        <tr class="style_line">
            <td>Sex</td>
            <td><select name="sexeCit" required="required">
                <option value="Masculin">Masculin</option>
                <option value="Feminin">Feminin</option>
                </select>
            </td>
        </tr>

        <tr class="style_line">
            <td>Date de naissance</td>
            <td><input type="date" name="dateNaissCit" required="required"></td>
        </tr>

        <tr class="style_line">
            <td>Lieu de naissance</td>
            <td><input type="text" name="lieuNaissCit"></td>
        </tr>


        <tr class="style_line">
            <td>Code Postal de naissance</td>
            <td><input type="text" name="cpLieuNaissCit" required="required"></td>
        </tr>

        <tr class="style_line">
            <td>Adresse de naissance</td>
            <td><input type="text" name="adresseCit"></td>
        </tr>

        <tr class="style_line">
            <td>Ville</td>
            <td><input type="text" name="villeCit"></td>
        </tr>

        <tr class="style_line">
            <td>Code postal Citoyen</td>
            <td><input type="text" name="cpCit" required="required"></td>
        </tr>

        <tr class="style_line">
            <td>Situation familiale</td>
            
            <td><select name="situationFamilialeCit">
                <option value="Célibataire">Célibataire</option>
                <option value="Marié(e)">Marié(e)</option>
                <option value="Divorcé(e)">Divorcé(e)</option>
                <option value="Pacsé(e)">Pacsé(e)</option>
                </select>
            
            </td>
        </tr>

        <tr class="style_line">
            <td>Email</td>
            <td><input type="email" name="emailCit" required="required"></td>
        </tr>

        <tr class="style_line">
            <td>Mot de passe</td>
            <td><input type="password" name="mdpUser" id="mdp" onblur="traiterPassword()" required="required"></td>
        </tr>

        <tr class="style_line">
            <td>Question secrète</td>
            <td>
                <select name="question">
                    <option value="ecoleprimaire">Ecole primaire</option>
                    <option value="persohisto">Personnage historique</option>  
                    <option value="premieramour">Premier amour</option>  
                    <option value="nommere">Nom de jeune fille de votre mère</option>  
                    <option value="profpref">Votre professeur préférer</option>  
                </select>
            
            </td>
        </tr>

        <tr class="style_line">
            <td>Réponse</td>
            <td><input type="text" name="reponse" required="required"></td>
        </tr>

    
        <tr class="style_line">
            <td><input style="width:50%;margin-left:20px;" type="reset" name="Annuler" value="Annuler"></td>
            <td><input style="width:50%;margin-left:40px;" type="submit" name="Sinscrire" value="S'inscrire"></td>
        </tr>
       

        
    </table>
</form>
    </div>

</div>



<?php
    if(isset($_POST['Sinscrire']))
    {
        
        //verification dans la base
        $chaine="*";
        $where=array("emailCit"=>$_POST["emailCit"]);
        $unControleur->setTable("citoyen");
        $unCitoyen=$unControleur->selectWhere($chaine,$where);

        // verification si email a été deja utilisé
        if(isset($unCitoyen['emailCit']))
        {
                echo"<div class='notif_email_pasvalide'>Cet email a été déjà utilisé!!!!</div>";
        }
        //insert into dans la table citoyen les infos un citoyen
        else {
            //$unControleur->setTable("citoyen");
            $tab = array(
                "nomCit"        =>  $_POST["nomCit"]
                , "prenomCit"   =>  $_POST["prenomCit"]
                , "sexeCit"     =>  $_POST["sexeCit"]
                , "dateNaissCit"   =>  $_POST["dateNaissCit"]
                , "lieuNaissCit"     =>  $_POST["lieuNaissCit"]
                , "cpLieuNaissCit"    =>  $_POST["cpLieuNaissCit"]
                , "adresseCit"     =>  $_POST["adresseCit"]
                , "villeCit"     =>  $_POST["villeCit"]
                , "cpCit"          =>   $_POST["cpCit"]
                , "situationFamilialeCit"  =>   $_POST["situationFamilialeCit"]
                , "emailCit"               =>   $_POST["emailCit"]
                , "question"               =>  sha1($_POST["question"]) 
                , "reponse"               =>   sha1($_POST["reponse"])
                
            );
            //check si email saisi a déja utilisé
            $email=$_POST["emailCit"];
            $where=array("emailUser"=>$email);
            $unControleur->setTable ("user");
            $unCitoyen = $unControleur->selectWhere("*",$email); 
            if(isset($unCitoyen['emailUser']))
            {
                echo "Cet email a été déjà utilisé";
                return;
            }
            $unControleur->setTable("citoyen");
            $unControleur->insert ($tab);
            //insert dans la table user email et mot de passe un citoyen
            $unControleur->setTable("user");
            $tab1 =array(
                "emailUser" =>   $_POST["emailCit"],
                "mdpUser" =>   sha1($_POST["mdpUser"])
            );
            $unControleur->insert ($tab1);
            redirect("index.php?page=connexion");
        }
    }
?>
<script type="text/javascript">
    function traiterPassword()
        {
            let mdp = document.getElementById("mdp").value;
            if(mdp.length === 0)
            {
                alert("Veulliez de saisir votre mot de pass");
                return;
            }

            if (mdp.length <8 || mdp.length >50)
            {
                alert("Votre mot de passe est trop court ou trop long");
                return;
            }

            
            let contientMajuscule = 0;
            let contientMiniscule = 0;
            let contientChiffre = 0;
            let contientCharacterSpecial = 0;
            for(i=0;i<mdp.length;i++)
            {
                let chaine1="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                let chaine2="abcdefghijklmnopqrstuvwxyz";
                let chaine3="01234567891";
                let chaine4="!?@&";

                if(chaine1.indexOf(mdp.charAt(i)) > -1)
                    contientMajuscule = 1;

                if(chaine2.indexOf(mdp.charAt(i)) > -1)
                    contientMiniscule = 1;

                if(chaine3.indexOf(mdp.charAt(i)) > -1)
                    contientChiffre = 1;

                if(chaine4.indexOf(mdp.charAt(i)) > -1)
                    contientCharacterSpecial = 1;
            }
            
            if(contientMajuscule === 0)
            {
                alert("Mdp doit contenir au moins un caractère majuscule !");
                return;
            }
            if(contientMiniscule === 0)
            {
                alert("Mdp doit contenir au moins un caractère miniscule !");
                return;
            }
            if(contientChiffre === 0)
            {
                alert("Mdp doit contenir au moins un chiffre !");
                return;
            }

            if(contientCharacterSpecial === 0)
            {
                alert("Mdp doit contenir au moins un caractère spécial !");
                return;
            }

        }

</script>