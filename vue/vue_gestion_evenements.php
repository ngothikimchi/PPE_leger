<h3 class="titre_page_admin">Gestion all événements</h3>
<?php
 $lesEves = $unControleur->selectAll();

    echo"<table class=\"table table-striped \">
    <thead>
        <tr>
            <th scope=\"col\" >Id événément</th>
            <th scope=\"col\">Nom</th>
            <th scope=\"col\">Le contenu</th>
            <th scope=\"col\">Adresse</th>
            <th scope=\"col\">Date début événement</th>
            <th scope=\"col\">Date fin événement</th>
            <th scope=\"col\">Date fin d'inscription</th>
            <th scope=\"col\">Nombre participant maximum</th>
            <th scope=\"col\">Type événement</th>
            <th scope=\"col\">Association</th>
            <th scope=\"col\">Opération</th>
        </tr>
    </thead>
    <tbody>
        
        ";
    foreach($lesEves as $uneEv) {
        echo "
        <tr>
        <td>".$uneEv['idEve']."</td>
        <td>".$uneEv['nomEve']."</td>
        <td>".$uneEv['contenuEve']."</td>
        <td>".$uneEv['adresseEve']."</td>
        <td>".$uneEv['debutEve']."</td>
        <td>".$uneEv['finEve']."</td>
        <td>".$uneEv['dateFinInscriptionEve']."</td>
        <td>".$uneEv['nbParticipantMaxEve']."</td>
        <td>".$uneEv['codeTypeEve']."</td>
        
        <td>".$uneEv['idAssocEve']."</td>
       
        <td>
        <a href='gestion_evenement.php?action=sup&idEve=".$uneEv['idEve']."'> 
        <img src ='images/supp.jpg' height='15' width='15'> </a>

    <a href='gestion_evenement.php?action=edit&idEve=".$uneEv['idEve']."'> 
        <img src ='images/edit.png' height='15' width='15'> </a>
        </td>
        </tr>";       
    }
     
    echo"  
        
    </tbody>
    </table>";

?>