<h3 style="margin-top:20px;margin-bottom:20px;">Gestion de type événement d'enfant</h3>

<table class="table table-striped ">
    <thead>
        <tr>       
        <th scope="col">Code</th>
        <th scope="col">Nom type événement</th>
        <th scope="col">Tranche age min</th>
        <th scope="col">Tranche age min</th>
        <th scope="col">Accompagant</th>
        <th scope="col">Opération</th>
         
     </tr>   
    </thead>
   
    <tbody>
    <?php
    foreach($lesTypeEveEnfant as $unTypeEveEnfant)
    {
        $str="
        <tr>
            <td> ".$unTypeEveEnfant['codeTypeEve']. "</td>
            <td> ".$unTypeEveEnfant['nomTypeEve']. "</td>
            <td> ".$unTypeEveEnfant['trancheAgeMin']. "</td>               
            <td> ".$unTypeEveEnfant['trancheAgeMax']."</td>
            <td> ".$unTypeEveEnfant['accompagnant']. "</td>
           
                     
            <td> 
                <a href='gestion_all_type_Eve.php?action=modifier&codeTypeEve=".$unTypeEveEnfant['codeTypeEve']."'> 
            <img src ='./images/edit.png' height='30' width='30'>
                </a>
                <a href='gestion_all_type_Eve.php?action=supprimer&codeTypeEve=".$unTypeEveEnfant['codeTypeEve']."'> 
            <img src ='./images/supp.jpg' height='30' width='30'>
                </a>
            </td> </tr>
               " ;
        echo $str;        
    }
    ?>

    </tbody>
</table>