<?php
     $unControleur->setTable ("gestion_demande_pluriel_view");
     $lesDemandeMs = $unControleur->selectAll();  

     if(!isset($_SESSION['role']) || $_SESSION['role'] != '2')
    {
        require_once("vue/vue_connexion.php");     
        return;
    }
?>

<h3 style="margin-top:20px;margin-bottom:20px;">Gestion de la demande pluriel</h3>
<div class="style_demande_p">
<table class="table table-striped ">
    <thead>
        <tr>       
        <th scope="col">ID Demande</th>
        <th scope="col" >Type Demande</th>
        <th scope="col" >État</th>
        <th scope="col" >ID Citoyen1</th>
        <th scope="col" >Nom Citoyen1</th>
        <th scope="col" >Prénom Citoyen1</th>
        <th scope="col" >Email Citoyen1</th>
        <th scope="col">ID Citoyen2</th>
        <th scope="col">Nom Citoyen2</th>
        <th scope="col">Prénom Citoyen2</th>
        <th scope="col">Email Citoyen2</th>
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
            <td> ".$uneDemande['typeDemande']. "</td>
            <td> ".$uneDemande['etatDemande']. "</td>               
            <td> ".$uneDemande['idCit1']."</td>
            <td> ".$uneDemande['nomCit1']. "</td>
            <td> ".$uneDemande['prenomCit1']. "</td>
            <td> ".$uneDemande['emailCit1']. "</td>
            <td> ".$uneDemande['idCit2']."</td>
            <td> ".$uneDemande['nomCit2']. "</td>
            <td> ".$uneDemande['prenomCit2']. "</td>
            <td> ".$uneDemande['emailCit2']. "</td>
            <td> ".$uneDemande['dateDemande']. "</td>
            <td> ".$uneDemande['dateRep']. "</td>
            <td> ".$uneDemande['traiteePar']. "</td>           
            <td>
               " ;
        if($uneDemande['etatDemande']== 'En cours de traitement')
        {
            $str=$str."<a href='gestion_demande_pluriel.php?action=valider&idDemande=".$uneDemande['idDemande']."'> 
                         <img src ='./images/valider.png' height='15' width='15'>
                        </a>
                         <a href='gestion_demande_pluriel.php?action=refuser&idDemande=".$uneDemande['idDemande']."'> 
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
</div>