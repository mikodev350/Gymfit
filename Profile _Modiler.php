<?php
session_start();
include './function.php';

if(isset($_SESSION['Email'])){
//la premier table
$email=$_SESSION['Email'];
$sql="SELECT * FROM inscription_gymfit WHERE addres_m='$email'";
$data=GetfromDB($sql);
$id=$data['id'];
$e=$data['addres_m'];
$N=$data['N_numero'];
}


 $Email_Modiff="";
 $Number="";
 $NewPassword="";
 $Oldpassword="";
 $err=[];

if(isset($_POST['Modifier'])){

    $Email_Modiff=traiter_input($_POST['Email']);;
    $Number=traiter_input($_POST['number']);

    if (empty($Email_Modiff)){
        $err['Email']="Please enter your Email!!!";
    }elseif (!preg_match("/^[a-zA-Z\-_\.0-9]+@[a-zA-Z\-_\.0-9]+\.[a-zA-Z]+$/", $Email_Modiff)) {        
        $err['Email']="Email invalid !!!";
    }elseif (strlen($Email_Modiff)>99) {        
        $err['Email']="Email too long !!!";
    }

    
    if (empty($Number)){
        $err['number']="Please enter your telephone number !!!";
    }elseif (!preg_match("/^(0|\+213|00213)(5|6|7)[0-9]{8}$/", $Number)) {        
        $err['number']="Telephone numbers invalid!!!";
    }

    if(empty($_POST['OldPassword'])&& empty($_POST['NewPassword'])){

        if(count($err) == 0){
            $Moddfier="UPDATE inscription_gymfit SET addres_m='$Email_Modiff', N_numero='$Number' WHERE id='$id'";
            InsertIntodata($Moddfier);
            $_SESSION['Email']=$Email_Modiff;
            header("Location:Profile.php");

        }
    }else{
        $Oldpassword=traiter_input($_POST['OldPassword']);
        $Newpassword=traiter_input($_POST['NewPassword']);

   
             if(password_verify($Oldpassword, $data['mots_pass'])){

            $Newpassword=password_hash($Newpassword,PASSWORD_DEFAULT );
              $Moddfier="UPDATE inscription_gymfit SET addres_m='$Email_Modiff', N_numero='$Number',mots_pass='$Newpassword' WHERE id='$id'";
               InsertIntodata($Moddfier);
               header("Location:Profile.php");
             }else{
               $err['OldPassword']='this is not your passwords';
             }
    
    }

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
       <br>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
          <div class="info">
               <h3>Information</h3>
                <div class="info_data">
                     <div class="data">
                        <h4>Email</h4>
                         <input class="input-info" type="email" placeholder="Email"  name="Email" value="<?php echo $e;?>" required />                 
                     </div>
                     <div class="data">
                        <h4>Phone</h4>
                          <input  class="input-info" type="text"  value="<?php echo $N ;?>" placeholder="phone number * " name="number" required/>
                     </div>
               </div>
           </div>
      
           <div class="days">
                  <h3>passwords </h3>
                    <div class="days_data">
                        <div class="data">
                          <h4>change your passwords</h4>
                             <input class="input-info" id="pwd1" type="password" placeholder=" old Password *(min  8)" name="OldPassword" />    
                            <span style="color:red;"><?php if (isset($err['OldPassword'])) echo $err['OldPassword']; ?></span>

                           <input class="input-info" id="pwd2" type="password" placeholder=" new Password *(min  8)" name="NewPassword" >
                           <span style="color:red;"><?php if (isset($err['NewPassword'])) echo $err['NewPassword']; ?></span>                                     
                        </div>
                        <div class="data">
                            <div id="look_Pasword" ><i class="fas fa-eye"></i></div>
                            <div id="look_Pasword2" ><i class="fas fa-eye"></i></div>
                       </div>
                   </div>
                <br>

                   <button value="Modifier" name="Modifier">edit</button>
            </div>
         </form>
    </div>
</div>


<script>

    //eyes n 1
        document.getElementById("look_Pasword").addEventListener("click", function(e){
        var pwd = document.getElementById("pwd1");
        if(pwd.getAttribute("type")=="password"){
            pwd.setAttribute("type","text");
            document.getElementById("look_Pasword").style.color="#007BFF";
        } else {
            pwd.setAttribute("type","password");
            document.getElementById("look_Pasword").style.color="black";

        }
    });
    //eyes n 2

    document.getElementById("look_Pasword2").addEventListener("click", function(e){
        var pwd = document.getElementById("pwd2");
        if(pwd.getAttribute("type")=="password"){
            pwd.setAttribute("type","text");
            document.getElementById("look_Pasword2").style.color="#007BFF";

        } else {
            pwd.setAttribute("type","password");
            document.getElementById("look_Pasword2").style.color="black";

        }
    });
         </script>
</body>
</html>