
<!-- form html pour saisir infos connexion un user -->
<form method="post" action="">
    <div class="bloque_formulaire_de_connexion">
        <div class="formulaire_saisir">
            <div class="header_connexion">Sign in</div>
            <div class="body_connexion">
                <input class="input_connexion top_input_connexion" type="text" placeholder="Email" name="emailUser">
                <input class="input_connexion" type="password" name="mdpUser" placeholder="Mot de pass">
                <div class="lien_connexion"><a href="gestion_mdp_oublie.php">Mot de pass oublié</a></div>
                <input class="input_connexion" type="submit" name="SeConnecter" value="Se connecter">>
                <div class="lien_connexion" style="color:black;">Vous n'avez pas le compte?</div>
                <div class="lien_connexion bottom_lien_connexion" ><a href="#">Inscrivez-vous</a></div>    
            </div>

        </div>
    </div>
</form>

<!-- <form method="post" action="">
    <table>
        <tr>
            <td>Email:</td>
            <td><input type="text" name="emailUser"></td>
        </tr>
        <tr>
            <td>MDP:</td>
            <td><input type="password" name="mdpUser"></td>
        </tr>
        <tr>
            <td><input type="reset" name="Annuler" value="Annuler"></td>
            <td><input type="submit" name="SeConnecter" value="Se connecter"></td>
        </tr>      
    </table>
</form>
<p><a href="gestion_mdp_oublie.php">Mot de passe oublié</a></p> -->

<?php
    if(isset($_POST['SeConnecter']))
    {
        $email=$_POST['emailUser'];
        //$mdp=$_POST["mdpUser"];
        $mdp = sha1($_POST['mdpUser']);
        //verification dans la base
        $chaine="*";
        $where=array("emailUser"=>$email, "mdpUser"=>$mdp);
        $unControleur->setTable("user");
        $unUser=$unControleur->selectWhere($chaine,$where);
        if(isset($unUser['emailUser']))
        {
            $_SESSION['email']  =   $unUser['emailUser'];
            $_SESSION['role']   =   $unUser['idRoleUser'];
            
            if($_SESSION['role'] == 2 )//admin
            {
                $unControleur->setTable("employe");
                $chaine="*";
                $where=array("emailEmploye"=>$unUser['emailUser']);
                $unEmploye=$unControleur->selectWhere($chaine,$where);
                
                $_SESSION['idEmploye']=$unEmploye['idEmploye'];
                $_SESSION['idServiceEmploye']=$unEmploye['idServiceEmploye'];

                // Fonction de redirection (regarder dans function.php)                
                if($_GET['page'] != 'connexion')
                    redirect($_SERVER['REQUEST_URI']);
                else
                    redirect('index.php');
                exit();
            }

            if($_SESSION['role'] == 1 )//user
            {
                $unControleur->setTable("citoyen");
                $chaine="*";
                $where=array("emailCit"=>$unUser['emailUser']);
                $unCitoyen=$unControleur->selectWhere($chaine,$where);
                
                $_SESSION['idCit']   =   $unCitoyen['idCit'];
                $_SESSION['dateNaissCit']   =   $unCitoyen['dateNaissCit'];
                //Fonction de redirection (regarder dans function.php)                
                if($_GET['page'] != 'connexion')
                    redirect($_SERVER['REQUEST_URI']);
                else
                    redirect('index.php');

                exit();
            }
        }
        
        else{
            echo "<div class='notification'>Veuillez vérifier vos identifiants</div>";
        }
    }
?>