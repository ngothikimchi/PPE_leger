
<div class="title_info1 center color_text1">Participer aux événements</div>
<?php

    $idEve = $_GET['idEve'];

?>
<div class="formulaire_inscription">
<form  method="post" action="">
<table >

  <tr>
    <td class="title_input">Nom citoyen</td>
    <td><input required type="text" class="contenu_input"  name="nom"  value=""> </td>
</tr>
<tr>
<td class="title_input">Prénom citoyen</td>
    <td><input required type="text" class="contenu_input"  name="prenom"  value=""> 
</tr>
   <tr>
<td class="title_input">Age</td>
    <td><input required type="text" class="contenu_input"  name="age"  value="">  </td>
</tr>
<tr>
<td class="title_input">Email</td>
    <td><input required type="text" class="contenu_input"  name="email"  value=""> </td>
</tr>
    
    <tr>
    <td class="title_input">Téléphone</td>
    <td><input required type="text" class="contenu_input"  name="tel"  value=""> </td>
  </tr>  
</table>
<br>
<button type="submit" class="btn btn-default" name="participer">Envoyer</button>  
</form>

</div>


<?php
if(isset($_POST['participer']))
{
    // vérifier l'age de participer
    $unControleur->setTable ("evenement");
    $age_user=$_POST["age"];
    $age_limit=$unControleur->verifiAge();

    if($age_user > $age_limit)
        echo "Votre age n'est pas validé pour participer à cet événément";
    else
    {
        $unControleur->setTable ("participer");
            $currentDate = date("Y-m-d H:i:s");
            $tab = array(
                "nom"     =>  $_POST["nom"]
                , "prenom"  =>  $_POST["prenom"]
                , "age"     =>  $_POST["age"]
                , "email"   =>  $_POST["email"]
                , "tel"     =>  $_POST["tel"]
                , "date_inscription"    =>  $currentDate
                , "tel"     =>  $_POST["tel"]
                , "id_eve"  =>  $id_eve
            );
            $unControleur->insert ($tab);

            $unControleur->setTable ("evenement");
            $chaine ="*"; 
            $where = array("id_eve"=>$id_eve);
            $uneEve = $unControleur->selectWhere($chaine, $where);
            $nom_eve = $uneEve['nom_eve'];


            $params = array();
            $params["nom"] = $_POST["nom"];
            $params["prenom"] = $_POST["prenom"];
            $params["date_inscription"] = $currentDate;
            $params["nom_eve"] = $nom_eve;


            $to=$_POST["email"];
            
            redirect("notification.php");
    }
  
  
  
     

      // EnvoyerEmailNotification($to);

      // echo("<script>location.href = 'notification.php';</script>"); 
      //code pour exclude age pas valide
}

 ?>