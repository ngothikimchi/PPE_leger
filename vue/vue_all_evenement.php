<?php
     $unControleur->setTable ("evenement_association_view");
    $lesEves = $unControleur->selectAll();
?>
<br>
<div class="title_info1 center color_text1 " style="text-align:center;">Participer aux événements</div>


<?php
  foreach($lesEves as $uneEv) 
  {
    $currentDate = date("Y-m-d");
    // $currentDate = date_create('2022-01-20');
    $date_fin_inscription =  date_create($uneEv['dateFinInscription']);
    $date_debut_eve =  date_create($uneEv['debutEve']);
    $date_fin_eve =  date_create($uneEv['finEve']);

    $str = "    
    <div class=\"container blog_evenement\">  
  
    
      <div class=\"nom_evenement\">".$uneEv['nomEve']."</div>
      <div class=\"contenu_evenement\">".$uneEv['contenu'].".<br>
          Cet événement se passera du ".date_format($date_debut_eve, 'd/m/Y')." à".date_format($date_fin_eve, 'd/m/Y')." par ".$uneEv['association'].", ".$uneEv['adresse']."<br>
          Le fin d'inscription pour tout le monde : ".date_format($date_fin_inscription, 'd/m/Y').". <br>
          Le nombre de participant : ".$uneEv['nbParticipantMax'].".<br>
          
      </div>";

        if($date_fin_eve > $currentDate)
        {
          $str=$str."<div>
          <a href=\"evenement.php?idEve=".$uneEv['idEve']."\" type=\"button\" class=\"btn btn-primary\">Participer</a>
        </div>
       
        </div>";
        }
        else
        {
          $str=$str."Cet événement a déjà expiré ";
        }
    echo $str;
    echo "<br>";
  }
?>  

    </tbody>

</table>