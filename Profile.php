<?php
session_start();

include './function.php';
//la premier table
 $email=$_SESSION['Email'];
 $sql="SELECT * FROM inscription_gymfit WHERE addres_m='$email'";
 $data=GetfromDB($sql);
 $id=$data['id'];

//date supression 
if(isset($id)){
 //la 2 table
 $sql1="SELECT * FROM offre_gymfit WHERE id_utilisateur='$id'";
 $data1=GetfromDB($sql1);

 //date aujhourdhui
 $date= new DateTime();
 $date->getTimestamp();
 $date=$date->format('Y-m-d');

 $datefin= new DateTime($data1['date_fin']);
 $datefin->getTimestamp();
 $datefin=$datefin->format('Y-m-d');
   //apres l abonnemet
 
   if($date >= $datefin){
    $value="DELETE FROM offre_gymfit WHERE id_utilisateur='$id'";
    InsertIntodata($value);
  }


}
if(isset($_POST['renewal'])){
    $_SESSION['id']=$id;

    if ($data['sexe']=='Male') {
        header("Location:Offre.php");
    }else{
        
        header("Location:Offre-f.php");
    }

}


if(isset($_POST['Deconnection'])){
   
    session_destroy();
    header("Location:log.php");

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <link rel="stylesheet" type="text/css" href="css/Profil.css">


    <title>Document</title>
</head>
<body>
  



<div class="wrapper">
    <div class="left">
        <img src="img/icons8-utilisateur-96.png" alt="user" width="100">
        <h3><?php echo $data['nom'] . $data['Prenom']?></h3>
         <p style="font-size: 15px;"></p>Age : <?php echo $data['Age'] ?></p>
         <p style="font-size: 15px;">Sex : <?php echo $data['sexe'] ?></p>
    </div>
    
    <div class="right">
        <div class="Modification">
            <ul><li><a href="Profile _Modiler.php
"><i class="fas fa-pen"></i></a></li></ul>
           </div>
        <div class="info">
            <h3>Information</h3>
            <div class="info_data">
                 <div class="data">
                    <h4>Email</h4>
                    <p> <?php echo $data['addres_m'] ?></p>
                 </div>
                 <div class="data">
                   <h4>Phone</h4>
                    <p><?php echo $data['N_numero'] ?></p>
                 </div>
            </div>
        </div>
      
        <?php if(isset($data1['id_utilisateur'])){?>
        <div class="days">
               <h3>days </h3>
               <div class="days_data">
                   <div class="data">
                       <h4>start date</h4>
                        <p><?php echo $data1['date_debut'] ?></p>
                    </div>
                   <div class="data">
                      <h4>end of date</h4>
                       <p><?php echo $data1['date_fin'] ?></p>
                   </div>
                </div>
            <br>
           
            <div class="data">
                <h4>days of work</h4>
                 <p style="color:grey"><?php echo $data1['jours_entrenement'] ?></p>
            </div>
        </div>
        <?php }else{  ?>
            <br>

            <div style="text-aligne:center">
            <form action="#" method="POST">
            <h4>renew subscription :</h4>
            <br>    <br>
        
            <button name="renewal">renewal</button>
            </form>
            </div>
           
            <br>
            <br>
        <?php } ?>

<form action=""  method="POST">
        <button name="Deconnection">Logout</button>
        </form>
        
    </div>
</div>

<style>

</style>
</body>
</html>