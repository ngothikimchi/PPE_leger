<?php
    require_once("header.php");
?>
<br>
<div class="formulaire_demande_pluriel">
    <form method="post">
        <table>
            <tr>
                <td>ID Citoyen </td>
                <td><input type="text" name="idcitoyen2"></td>
                <td><input type="submit" name="Valider" value="Demander"></td>
            </tr>
        </table>
    </form>
</div>

<?php
if (isset($_POST['Valider'])  && isset($_GET['idTypeDem']))
{
    $currentDate = date("Y-m-d H:i:s");
            $unControleur->setTable ("demande_pluriel");   
            $tab = array(                       
                 "dateDemande"     =>  $currentDate
                , "idCit1"   =>  $_SESSION['idCit']
                , "idCit2"   =>  $_POST['idcitoyen2']
                , "idTypeDem"     => $_GET['idTypeDem']
           );
    //à faire vérifier 
    $unControleur->setTable ("citoyen");  
    $idCitoyen1 = $_SESSION['idCit'];
    $where = array("idCit"=>$idCitoyen1);
    $unCitoyen1=$unControleur->selectWhere("*",$where);
    $statutCit1=$unCitoyen1["situationFamilialeCit"];

    $idCitoyen2 = $_POST['idcitoyen2'];
    $where = array("idCit"=>$idCitoyen2);
    $idCitoyen2=$unControleur->selectWhere("*",$where);
    $statutCit2=$idCitoyen2["situationFamilialeCit"];

    $typeDemande=$_GET['idTypeDem'];
    //echo  $typeDemande;
    //si dans le cas de demander mariage, verifier les status les deux 
    if($typeDemande == 1)
    {
        if($statutCit1 =="Marié(e)" || $statutCit2 =="Marié(e)")
        {
            echo "<div class='notification'>Votre status ne permettent pas de demander ce type de service!!</div>";
            return;
        }
    }
    //si dans le cas de divorce
    if($typeDemande == 5)
    {
        if($statutCit1 !=="Marié(e)" || $statutCit2 !=="Marié(e)")
        {
            echo "<div class='notification'>Votre status ne permettent pas de demander ce type de service divorce!!</div>";
            return;
        }
    }
    //si dans le cas de PAcs
    if($typeDemande == 4)
    {
        if($statutCit1 !=="Célibataire" || $statutCit2 !=="Célibataire")
        {
            echo "<div class='notification'>Votre status ne permettent pas de demander ce type de service PACs!!</div>";
            return;
        }
    }
   
    // fin check
    $unControleur->setTable ("demande_pluriel");   
    $unControleur->insert ($tab); 
    echo "<div class='notification'>Votre demande a été envoyée </div>";   
}
?>

<?php
    require_once("footer.php");
?>