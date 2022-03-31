<?php
    require_once("header.php");
    $unControleur->setTable ("type_demande");
    $lestypeDemandes= $unControleur->selectAll();

    if(!EstCitoyen())
    {
        echo "<br>Merci de se connecter en tant que citoyen pour demander les services";
        return;
    }
?>


<div style ="text-align:center;" class="title_info1 center color_text1">Liste de services en ligne</div>

<div>
    <table class="table table-hover" style="width:50% !important;">
        <thead >
            <tr>
                <td scope="col" style ="font-weight:bolder;">Liste de service</td>
                <td scope="col" style ="font-weight:bolder;">Choisir en cliquant</td>
            </tr>
        </thead>
        <tbody>
   <?php
        foreach($lestypeDemandes as $unetypeD) 
        {
            echo "<tr> 
            <td>";
            echo $unetypeD['nomTypeDem'];
            echo "</td>
            <td>
                <a href=\"service_administration.php?idTypeDem="
                    .$unetypeD['idTypeDem']
                    ."&etrePlurielDem="
                    .$unetypeD['etrePlurielDem']."\">Cliquer ici
                </a>
            </td>
            </tr> ";
        }
    ?>
   
        </tbody>
    </table>
    <?php
  



    
    if (isset($_GET['idTypeDem']) && isset($_GET['etrePlurielDem']))
    {
        if(! $_GET['etrePlurielDem']) 
        {
            $currentDate = date("Y-m-d H:i:s");
            $unControleur->setTable ("demande_mono");   
            $tab = array(                       
                 "dateDemande"     =>  $currentDate
                , "idCit"   =>  $_SESSION['idCit']
                , "idTypeDem"     => $_GET['idTypeDem']
           );
    
            $unControleur->insert ($tab); 
            echo "Votre demande a été envoyé";
        }
        else{
            
            redirect("demande_pluriel.php?idTypeDem=".$_GET['idTypeDem']);
        } 
    }
    ?>
</div>
<?php
require_once("footer.php");
?>


