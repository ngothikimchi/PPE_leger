<?php	
        require_once("header.php");
?>

<?php
    if(isset($_GET["type"]) && $_GET["type"] == "success")
        echo "<div class='notif_reconnecter'>Votre nouveau mot de passe a été enregistré. 
        <br>Merci de reconnecter en cliquant sur Connexion.</div>";
    else
    {
?>
<div class="formulaire_mdp_oublie">
    <div class="header_mdp_oublie">Mot de passe oublié </div>
    <div class="titre_mdp_oublie">Indiquez l'adresse email, question secrète et réponse à votre compte pour générer un nouveau mot de passe</div>
    <form method="post" action="">
        
        <table>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="emailCit"></td>
            </tr>
            <tr>
                <td>Question secrète:</td>
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

            <tr>
                <td>Reponse:</td>
                <td><input type="text" name="reponse"></td>
            </tr>
            <tr>
                <td>Nouveau mot de passe:</td>
                <td><input type="password" name="mdpUser" id="mdp" onblur="traiterPassword()"></td>
            </tr>
            <tr>
                <td><input type="reset" name="Annuler" value="Annuler"></td>
                <td><input type="submit" name="Valider" value="Valider"></td>
            </tr>      
        </table>
    </form>
</div>


<?php
    }
?>
<?php
    if(isset($_POST['Valider']))
    {
        $chaine="*";
        $email_saisi=$_POST["emailCit"];
        $question_saisi=sha1($_POST["question"]);
        $reponse_saisi=sha1($_POST["reponse"]);
        $where=array("emailCit"=>$email_saisi,"question"=>$question_saisi,"reponse"=> $reponse_saisi);
        $unControleur->setTable("citoyen");
        $unCitoyen=$unControleur->selectWhere($chaine,$where);
        if(!isset($unCitoyen['emailCit']) || !isset($unCitoyen['question']) || !isset($unCitoyen['reponse']))
        {
            echo "Votre email ou votre question secrète n'est pas validé";
            return;
        }
        
 
        $unControleur->setTable("user");
        $where = array("emailUser"=>$_POST['emailCit']);
        $tab=array(           
                "mdpUser"=>sha1($_POST["mdpUser"])
                );
        $unControleur->update ($tab, $where); 
        
        redirect("gestion_mdp_oublie.php?type=success");
    }
?>

<?php
        require_once("footer.php");      
?>
<!-- JavaScript securite saisir mot de passe -->
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

<?php
    require_once("footer.php")
?>