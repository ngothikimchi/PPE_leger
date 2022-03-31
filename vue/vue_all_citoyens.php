
<div class="position_table_gestion">
<h3 style="margin-top:20px;margin-bottom:20px;">Gestion de citoyens</h3>

<table class="table table-striped sharp_table" >
    <thead>
        <tr>       
        <th scope="col">ID</th>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Sexe</th>
        <th scope="col">Date de naissance</th>
        <th scope="col">Lieu de naissance</th>
        <th scope="col">CP lieu de naissance</th>
        <th scope="col">Adresse</th>
        <th scope="col">Ville</th>
        <th scope="col">CP adresse</th>    
        <th scope="col">Situation familiale</th>  
        <th scope="col">Email</th>        
        <th scope="col">Opération</th>  
     </tr>   
    </thead>
   
    <tbody>
    <?php
    foreach($lesCitoyens as $unCitoyen)
    {
        $str="
        <tr>
            <td> ".$unCitoyen['idCit']. "</td>
            <td> ".$unCitoyen['nomCit']. "</td>
            <td> ".$unCitoyen['prenomCit']. "</td>               
            <td> ".$unCitoyen['sexeCit']."</td>
            <td> ".$unCitoyen['dateNaissCit']. "</td>
            <td> ".$unCitoyen['lieuNaissCit']. "</td>
            <td> ".$unCitoyen['cpLieuNaissCit']. "</td>
            <td> ".$unCitoyen['adresseCit']. "</td>
            <td> ".$unCitoyen['villeCit']. "</td>
            <td> ".$unCitoyen['cpCit']. "</td> 
            <td> ".$unCitoyen['situationFamilialeCit']. "</td>
            <td> ".$unCitoyen['emailCit']. "</td>
                     
            <td> 
                <a href='gestion_citoyen.php?action=modifier&idCit=".$unCitoyen['idCit']."'> 
            <img src ='./images/edit.png' height='15' width='15'>
                </a>
                <a href='gestion_citoyen.php?action=supprimer&idCit=".$unCitoyen['idCit']."'> 
            <img src ='./images/supp.jpg' height='15' width='15'>
                </a>
            </td> </tr>
               " ;
        echo $str;        
    }
    ?>

    </tbody>
</table>
</div>
