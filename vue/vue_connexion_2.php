<?php
    require_once("header.php");
?>
<div class="bloque_formulaire_de_connexion">
    <div class="formulaire_saisir">
        <div class="header_connexion">Sign in</div>
        <div class="body_connexion">
            <input class="input_connexion top_input_connexion" type="text" placeholder="Email">
            <input class="input_connexion" type="text" placeholder="Mot de pass">
            <div class="lien_connexion"><a href="#">Mot de pass oublié</a></div>
            <input class="input_connexion" type="submit" value="Se connecter" name="Valider">
            <div class="lien_connexion" style="color:black;">Vous avez le compte?</div>
            <div class="lien_connexion bottom_lien_connexion" ><a href="#">Inscrivez-vous</a></div>
            
        </div>

    </div>
</div>
<?php
    require_once("footer.php");
?>