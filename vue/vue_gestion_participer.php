<?php
     $unControleur->setTable ("participer_citoyen_evenement_view"); 
     $lesPartEves = $unControleur->selectAll();  
     echo"<br><br><h2 style=\"margin-top:20px;margin-bottom:20px;\">Gestion all participants</h2>";
     echo"<table class=\"table table-striped \">
     <thead>
         <tr>
             <th scope=\"col\">Id citoyen</th>
             <th scope=\"col\">Nom</th>
             <th scope=\"col\">Prénom</th>
             <th scope=\"col\">événement</th>
             <th scope=\"col\">Date demande</th>
             
             
         </tr>
     </thead>
     <tbody>
         
         ";

         foreach($lesPartEves as $uneParticiper) {
            echo "
            <tr>
            <td>".$uneParticiper['idCit']."</td>
            <td>".$uneParticiper['nomCit']."</td>
            <td>".$uneParticiper['prenomCit']."</td>
            <td>".$uneParticiper['nomEve']."</td>
            <td>".$uneParticiper['dateDemande']."</td>
        
            </tr>";
           
        }
         
        echo"         
        </tbody>
        </table>";
    




?>