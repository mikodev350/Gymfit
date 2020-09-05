<?php
session_start();
include './login._ferifie.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Connection.css">
    <link rel="stylesheet" type="text/css" href="css/all.min.css">
    <script src="js/eyes.js" defer></script>

    <title>login or sign up</title>
</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-up-container">
    <form  action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <h1>Sign Up</h1>
             <br>
                <span>Champs Obligstoire(<span style="color: red;">*</span>)</span>
                <input class="input-info" type="text" placeholder="Last Name *"  name="Last_Name"  value='<?php echo $Last_Name ;?>' required/>
                <span style="color:red;"><?php if (isset($err['Name'])) echo $err['Name']; ?></span>

                <input class="input-info" type="text" placeholder="Name *" name="Name"  value='<?php echo $Name ;?>' required/>
                <span style="color:red;"><?php if (isset($err['Name'])) echo $err['Name']; ?></span>

              
                
                <input  class="input-info" type="number" min="13" max="60" placeholder="Age * " name="Age" value='<?php echo $Age ;?>'  required/>
                <span style="color:red;"><?php if (isset($err['Age'])) echo $err['Age']; ?></span>
                <input  class="input-info" type="text" placeholder="phone number * " name="number"  value='<?php echo $Number ;?>' required/>

                <span style="color:red;"><?php if (isset($err['number'])) echo $err['number']; ?></span>
                
                <input class="input-info" type="email" placeholder="Email *" name="Email" value='<?php echo $email ;?>'  required/>
                
                <span style="color:red;"><?php if (isset($err['Email'])) echo $err['Email']; ?></span>
               
                <input class="input-info" type="password" placeholder="Password *(min char 8)" name="Password"  id="pwd" required/>
                <div id="look_Pasword">
                   <i class="fas fa-eye"></i>
                    <span style="color:red;"><?php if (isset($err['Password'])) echo $err['Password']; ?></span>
                </div>
               

                <div class="input-radiobox">
                <span style="font-size:15px">Choose your gender (*):</span>
                <br>

                <input type= "radio" name="gender" value="Male"> Male 
                <input type= "radio" name="gender" value="Female"> Female <br>
                <span style="color:red;"><?php if (isset($err['gender'])) echo $err['gender']; ?></span>

                </div>
                <button  name="register" value="register">Sign Up</button>
            </form>
	</div>
	<div class="form-container sign-in-container">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <h1>Sign In</h1>
               
                <span>or use your account</span>
                <input class="input-info " type="email" placeholder="Email"  name="email_login"  value='<?php echo $Email ?> ' required />
                <span style="color:red;"><?php if (isset($err['email_login'])) echo $err['email']; ?></span>

                <input class="input-info" type="password" placeholder="Password"    name="Password_e" required/>
                <span style="color:red;"><?php if (isset($err['Password_e'])) echo $err['Password_e']; ?></span>
                <br>
                <a href=" password_oublier.php ">Forgot your password?</a>
                <button  name="Login"  id="Login" value="Login">Login</button>
                <a href="index.php"  name="Annuler" class="Annuler">Annuler</a>

      

            </form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
             <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>please login to your account</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
            <div class="overlay-panel overlay-right">
                    <h1>Hello,Welcome To GymFit !</h1>
                    <p>register now !</p>
                    <button class="ghost" id="signUp">Sign Up</button>
            </div>
		</div>
	</div>
</div>

<style>
.Annuler{
	border-radius: 20px;
	border: 1px solid#808080;
	background-color: #808080;
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	padding: 12px 30px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;
    margin-right: 13px;
    margin-left: 13px;

}
</style>
<script>
    const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
</script>
</body>
</html>
