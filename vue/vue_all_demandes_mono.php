<?php
    $unControleur->setTable ("gestion_demande_mono_view");
    $lesDemandeMs = $unControleur->selectAll();
    if(!isset($_SESSION['role']) || $_SESSION['role'] != '2')
    {
        require_once("vue/vue_connexion.php");     
        return;
    }
?>

<h3 style="margin-top:20px;margin-bottom:20px;">Gestion de la demande mono</h3>

<table class="table table-striped ">
    <thead>
        <tr>       
        <th scope="col" >ID</th>
        <th scope="col" >Type Demande</th>
        <th scope="col" >État</th>
        <th scope="col" >ID Citoyen</th>
        <th scope="col" >Nom Citoyen</th>       
        <th scope="col">Prénom Citoyen</th>
        <th scope="col">Email Citoyen</th>
        <th scope="col">Date de demande</th>
        <th scope="col">Date de répondre</th>    
        <th scope="col">Traitée par</th>  
        <th scope="col">Opérations</th>     
     </tr>   
    </thead>
   
    <tbody>
    <?php
    foreach($lesDemandeMs as $uneDemande)
    {
        $str="
        <tr>
            <td> ".$uneDemande['idDemande']. "</td>
            <td> ".$uneDemande['typeD']. "</td>
            <td> ".$uneDemande['etat']. "</td>               
            <td> ".$uneDemande['idCit']."</td>
            <td> ".$uneDemande['nomCit']. "</td>
            <td> ".$uneDemande['prenomCit']. "</td>
            <td> ".$uneDemande['emailCit']. "</td>
            <td> ".$uneDemande['dateDemande']. "</td>
            <td> ".$uneDemande['dateRep']. "</td>
            <td> ".$uneDemande['traiteePar']. "</td>           
            <td>
               " ;
        if($uneDemande['etat']== 'En cours de traitement')
        {
            $str=$str."<a href='gestion_demande_mono.php?action=valider&idDemande=".$uneDemande['idDemande']."'> 
                         <img src ='./images/valider.png' height='15' width='15'>
                        </a>
                         <a href='gestion_demande_mono.php?action=refuser&idDemande=".$uneDemande['idDemande']."'> 
                         <img src ='./images/refuser.png' height='15' width='15'>
                       </a>";
        }
        $str=$str."</td>
            </tr>";

        echo $str;        
    }
    ?>
    </tbody>

</table>