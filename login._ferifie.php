<?php
include './function.php';

$Last_Name="";
$Name="";
$email="";
$Age;
$Number="";
$password="";
$Gender="";
$err=[];
if (isset($_POST['register'])){


    $Last_Name=traiter_input($_POST['Last_Name']);
    $Name=traiter_input($_POST['Name']);
    $email=traiter_input($_POST['Email']);
    $Age=traiter_input($_POST['Age']);
    $Number=traiter_input($_POST['number']);
    $password=traiter_input($_POST['Password']);


    // Verification du nom
    if (empty($Last_Name)){
        $err['Last_Name']="Please enter your last name !!!";
    }elseif (!preg_match("/^[a-zA-Z ]+$/", $Last_Name)) {        
        $err['Last_Name']="Only alphabetical characters are allowed !!!";
    }elseif (strlen($Last_Name)>99) {
        $err['Last_Name']="The name must not exceed 99 characters !!";
    }


    // Verification du Prenom
    if (empty($Name)){
        $err['Name']="Please enter your name !!!";
    }elseif (!preg_match("/^[a-zA-Z ]+$/", $Name)) {        
        $err['Name']="Only alphabetical characters are allowed !!!";
    }elseif (strlen($Name)>99) {
        $err['Name']="The name must not exceed 99 characters !!";
    }


    // Verification de l'email

    if (empty($email)){
        $err['Email']="Please enter your Email!!!";
    }elseif (!preg_match("/^[a-zA-Z\-_\.0-9]+@[a-zA-Z\-_\.0-9]+\.[a-zA-Z]+$/", $email)) {        
        $err['Email']="Email invalid !!!";
    }elseif (strlen($email)>99) {        
        $err['Email']="Email too long !!!";
    }
    elseif(isset($email)){
        $sql="SELECT * FROM inscription_gymfit WHERE addres_m='$email'";
        $data=GetfromDB($sql);
        if($email === $data['addres_m']){
            $err['Email']="this email already exists!!!!";
        }
    }

     // Verification du numero 

     if (empty($Number)){
        $err['number']="Please enter your telephone number !!!";
    }elseif (!preg_match("/^(0|\+213|00213)(5|6|7)[0-9]{8}$/", $Number)) {        
        $err['number']="Telephone numbers invalid!!!";
    }elseif(isset($Number)){
        $sql="SELECT * FROM inscription_gymfit Where N_numero='$Number'";
        $data=GetfromDB($sql);
        if($Number === $data['N_numero']){
            $err['Email']="this email already exists!!!!";
        }
    }

     // vefification de l'age   

     if (empty($Age)){
        $err['Age']="Please enter your age !!!";
    }elseif(!preg_match("/^[0-9]+$/", $Number)) {   
         if($Age<'13'){
            $err['Age']="too young!";
           }elseif($Age>'60'){
            $err['Age']="too old!!!";
           }      
    }
     // Verification du  mots de pase

    
    if (empty($password)){
        $err['Password']="Please enter your Password !!!";
    }
    elseif(strlen($password)<8){
        $err['Password']="Your password is too short";
    }else{
        $password=password_hash($password,PASSWORD_DEFAULT );
    }

     // Choix du sex
     if(isset($_POST['gender'])){
         $Gender=$_POST['gender'];
     }else{
        $err['gender']="please choose your gender !!!!";
     }
    
   
    if (count($err)==0){
        //envoyer la BDD

        $value=" INSERT INTO inscription_gymfit(nom, Prenom, N_numero, Age , sexe, addres_m,mots_pass)"." VALUES ('$Last_Name','$Name','$Number','$Age','$Gender','$email','$password')";
        InsertIntodata($value);  
        $_SESSION['Email']=$email;
        if ($Gender=='Male') {
            header("Location:Offre.php");
        }else{
            
            header("Location:Offre-f.php");

        }

    }

}





// Login
$Email="";
$password_e="";
if(isset($_POST['Login'])){

    $Email=traiter_input($_POST['email_login']);
    $password_e=traiter_input($_POST['Password_e']);

// Verification de l'email

if (empty($Email)){
    $err['email_login']="Please enter your Email!!!";
}elseif (!preg_match("/^[a-zA-Z\-_\.0-9]+@[a-zA-Z\-_\.0-9]+\.[a-zA-Z]+$/", $Email)) {        
    $err['email_login']="Email invalid !!!";
}elseif (strlen($Email)>99) {        
    $err['email_login']="Email too long !!!";
}
// Verification du mots de passe

if (empty($password_e)){
    $err['Password_e']="Please enter your Password !!!";
}
if(count($err) == 0){
    
    $sql="SELECT * FROM inscription_gymfit WHERE addres_m='$Email'";
    $data= GetfromDB($sql);

     if(password_verify($password_e ,$data['mots_pass'])){
        $_SESSION['Email']=$Email;
        header("Location:Profile.php");
///sa reste vide
     }else{
        $err['Password_e']='this is not your passwords';
     }

}
}




?>