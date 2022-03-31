<h3 style="margin-top:20px;margin-bottom:20px;">Gestion de type événement d'adulte</h3>

<table class="table table-striped ">
    <thead>
        <tr>       
        <th scope="col">Code</th>
        <th scope="col">Nom type événement</th>
        <th scope="col">Opération</th>
     </tr>   
    </thead>
   
    <tbody>
    <?php
    foreach($lesTypeEveAdulte as $unTypeEveAdulte)
    {
        $str="
        <tr>
            <td> ".$unTypeEveAdulte['codeTypeEve']. "</td>
            <td> ".$unTypeEveAdulte['nomTypeEve']. "</td>        
            <td> 
                <a href='gestion_all_type_Eve.php?action=modifier&codeTypeEve=".$unTypeEveAdulte['codeTypeEve']."'> 
            <img src ='./images/edit.png' height='30' width='30'>
                </a>
                <a href='gestion_all_type_Eve.php?action=supprimer&codeTypeEve=".$unTypeEveAdulte['codeTypeEve']."'> 
            <img src ='./images/supp.jpg' height='30' width='30'>
                </a>
            </td> </tr>
               " ;
        echo $str;        
    }
    ?>

    </tbody>
</table>