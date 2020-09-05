<?php
session_start();
  include './function.php';

   $email="";
   $Number='';
   $p1="";
   $p2=""; 
   $err=[];
if(isset($_POST['confirmez'])){
  
    $email=traiter_input($_POST['Email']);
    $Number=traiter_input($_POST['number']);
    $p1=traiter_input($_POST['NewPassword']);
    $p2=traiter_input($_POST['NewPassword2']);



    // Verification de l'email

    if (empty($email)){
        $err['Email']="Please enter your Email!!!";
    }elseif (!preg_match("/^[a-zA-Z\-_\.0-9]+@[a-zA-Z\-_\.0-9]+\.[a-zA-Z]+$/", $email)) {        
        $err['Email']="Email invalid !!!";
    }elseif (strlen($email)>99) {        
        $err['Email']="Email too long !!!";
    }

     // Verification du numero 

     if (empty($Number)){
        $err['number']="Please enter your telephone number !!!";
    }elseif (!preg_match("/^(0|\+213|00213)(5|6|7)[0-9]{8}$/", $Number)) {        
        $err['number']="Telephone numbers invalid!!!";
    }
//verification du mots de pass

     if(strlen($p1)<8){
         $err['NewPassword']="Your password is too short";
      }elseif($p1===$p2){
          $p1=password_hash($p1,PASSWORD_DEFAULT);
      }else{
          $err['NewPassword']="the 2 passwords are not compatible";
      }
      
      // verification  si il existe
        $sql="SELECT * FROM inscription_gymfit Where addres_m='$email'";
        $data=GetfromDB($sql);
        $id=$data['id'];
        if($Number !== $data['N_numero']){  
            $err['number']="it is not your Phone Number!!!";
        }
        if($Number !== $data['N_numero']){  
            $err['number']="it is not your Phone Number!!!";
    }



    
    if (count($err)==0){ 
    
        $sql1="UPDATE inscription_gymfit SET mots_pass='$p1' WHERE id='$id'";       
        InsertIntodata($sql1); 
        header("Location:Inscription.php");
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
    <title>Forgot your password</title>
    <script src="js/eyes.js" defer></script>

</head>
<body>
    <br><br>
 
    <div class="container-password" >
        <div class="container-passworl">
        <br>

            <form action="#"  method="POST">
            <br>
                <h1>Find your account :</h1>
                <br>

                <input class="input_password" type="email" placeholder="Email *" name="Email" value="<?php echo $email ?>" required/>
                <span style="color:red;"><?php if (isset($err['Email'])) echo $err['Email']; ?></span>


                <input  class="input_password" type="text" placeholder="phone number * " name="number" value="<?php echo $Number ?>" required/>
                <span style="color:red;"><?php if (isset($err['number'])) echo $err['number']; ?></span>
                <br>
                
                 <h3>change your passwords :</h3>

                <div id="look_Pasword">
                   <i class="fas fa-eye"></i>
                </div>
                 <input class="input_password" id="pwd" type="password" placeholder=" new Password *(min  8)" name="NewPassword" >

                <div id="look_Pasword2">
                  <i class="fas fa-eye"></i>
                </div>
                <input class="input_password" id="pwd1" type="password" placeholder=" new Confirme Password" name="NewPassword2" >

                <span style="color:red;"><?php if (isset($err['NewPassword'])) echo $err['NewPassword']; ?></span>    
            <br><br>
                <button name="confirmez" value="confirmez" >Confirms</button>
                <a name="Annu" class="Annu"  href="log.php">Annuler</a>
            </form>
        </div>
        
    </div>


  <style>
      .container-password{

    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    position: relative;
    overflow: hidden;
    width: 650px;
    max-width: 100%;
    min-height: 550px;
}
      .input_password {
	background-color: #eee;
	border: none;
	padding: 10px 13px;
	margin: 4px 0;
	width: 50%;
}
.Annu{
	border-radius: 20px;
	border: 1px solid#808080;
	background-color: #808080;
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	padding: 12px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;
}



  </style>

    
</body>
</html>
