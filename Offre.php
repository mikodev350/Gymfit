<?php
session_start();
  include './function.php';
$offre='';
$T=[];
$v=[];
if(isset($_POST['confirme'])){
   
      //valeur la Date
       $date_Debut=$_POST['Date'];

    if(isset($_POST['subscription'])){

        $offre=$_POST['subscription'];
    }else{
        $T['subscription']="choose the type of subscription!!!";
    }

    // les jours
    if(isset($_POST['Days'])){
          $taill=0;
          $Jour_entrainement="";
        foreach( $_POST['Days'] as $v){
            $Jour_entrainement.=" - ". $v;
            $taill+=1;
    }
    }else{
        $T['Jour']="choose the day that suits you!!!";
    }

        //autre condition Plut tard
        switch($offre){
          case '1s':  if($taill!= 1){ $T['Jour']='please choose only one session';}; break;
          case '1S/week': if($taill!= 1){ $T['Jour']='please choose only one session';};break;
          case '2S/week': if($taill!= 2){ $T['Jour']='please choose a 2nd sessions';};break;
          case '3S/week': if($taill!= 3){ $T['Jour']='please choose a 3 sessions';};break;
    }


    //verification de la date 

    if(empty($date_Debut)){
        $T['Date']='please choose the Start date';
    }else{
         //la date lyoume
        $date= new DateTime();
        $date->getTimestamp();
        $date=$date->format('Y-m-d ');

        if(strtotime($date_Debut)<=strtotime($date)){
           $T['Date']='this date is old make sure to choose an earlier date !!';
        }
        $date_eterieur= "2020-11-30";
        if(strtotime($date_Debut) > strtotime($date_eterieur)){
          $T['Date']="don't go too far ! allah youstrouke!!";
       } 
        //fin de la date
    
    }
        $date_fin=date('Y-m-d');
        $date_fin = date('Y-m-d', strtotime($date_Debut. ' + 30 days'));

        //choix 1 seance
    if($offre==='1s'){
        $date_fin = date('Y-m-d', strtotime($date_Debut));
    }

    if (count($T)==0){
             $email=$_SESSION['Email'];
             $sql="SELECT * FROM inscription_gymfit WHERE addres_m='$email'";
             $data=GetfromDB($sql);
             $id=$data['id'];



        
        $value=" INSERT INTO offre_gymfit(id_utilisateur,offre_choisi, jours_entrenement,date_debut, date_fin)"."VALUES('$id','$offre','$Jour_entrainement','$date_Debut','$date_fin')";
         InsertIntodata($value);
         header("Location:Profile.php");

    }

  

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/all.min.css" rel="stylesheet"> 
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <title>Offre</title>
</head>
<body>
    <br><br>
 
    <div class="container" id="container">
        <div class="container ">
            <form action="#"  method="POST">
            <br><br>
                <h1>Choose your offers :</h1>
                <div class="input-radiobox">
                    <span style="font-size:20px">choose your subscription :</span>
                    <br><br>
    

                    <input type="radio" id="Basic" name="subscription" value="1s" onclick="checkboxlimiy(1)">
                    <label for="Basic"> Basic(1 session) </label><br>

                    <input type="radio" class="Basic"  name="subscription" value="1 S/week" onclick="checkboxlimiy(1)">
                    <label for="1S/week"> 1 Session/ week</label><br>
                
                    <input type="radio" class="Basic"  name="subscription" value="2S/week" onclick="checkboxlimiy(2)">
                    <label for="2S/week">2 Session/ week</label><br>

                    <input type="radio" class="Basic"  name="subscription" value="3S/week" onclick="checkboxlimiy(3)">
                    <label for="3S/week">3 Session/ week</label><br>
                    <span style="color:red">
                    <?php if (isset($T['subscription'])) echo $T['subscription']; ?></span>
                    </div>

                
                    <div id="Jours">
                        <span style="font-size:20px">Choose the days that suit you:</span>
                        <br>
                        <span tyle="font-size:14px">(Max:3 days)</span>
                        <br>
                            <input type="checkbox" class="Days" name="Days[]"value="Saturday"> Saturday	
                            <input type="checkbox" class="Days" name="Days[]" value="Sunday"> Sunday
                            <input type="checkbox" class="Days" name="Days[]" value="Monday"> Monday 
                            <input type="checkbox" class="Days" name="Days[]" value="Tuesday"> Tuesday
                            <br>
                            <input type="checkbox" class="Days" name="Days[]" value="Wednesday"> Wednesday 
                            <input type="checkbox" class="Days" name="Days[]" value="Thursday"> Thursday
                            <input type="checkbox" class="Days" name="Days[]" value="Friday"> Friday
                            <br>
                            <span style="color:red"><?php if (isset($T['Jour'])) echo $T['Jour']; ?></span>
                    </div>
                    <br>
                    <div>
                        <span style="font-size:20px">Choose the Start date :</span>
                         <br><br>
                        <label for="party">start date:</label>
                        <br>
                        <input class="Basic" type="date" id="Date" name="Date"  max="2020-12-31"><br>
                        <span style="color:red"><?php if (isset($T['Date'])) echo $T['Date']; ?></span>
                    </div>
                    <br>
                    <div>
                    <a name="Annuler" class="Annuler"  href="Profile.php">Annuler</a>
                    <button name="confirme" value="confirme">Confirmed</button>
                    </div>
                    <br>
                    
            </form>
        </div>
        
    </div>
    
<script>
   
             checkboxlimiy(3);


    function checkboxlimiy(lim){
        var Days=document.getElementsByClassName('Days');
        //var limit=2;
        var limit=lim;
        for (var i = 0; i < Days.length; i++){
              Days[i].onclick= function(){
              var Nombredecheck=0;
             for (var i=0; i< Days.length; i++){
                  Nombredecheck += (Days[i].checked)? 1 : 0;
                }
                if (Nombredecheck>limit){
                   alert("You can only select a maximum of "+limit+" checkboxes")
                  this.checked=false;
         
             }

            }
        }

}


</script>
  

    
</body>
</html>
