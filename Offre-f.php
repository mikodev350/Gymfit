<link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <title>Offre</title>
</head>
<body>
    <br><br>
 
    <div class="container" id="container">
        <div class="container ">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" >
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
                            <input type="checkbox" class="Days" name="Days[]" value="Tuesday"> Tuesday
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
                    <a name="Annuler" class="Annuler"  href="">Annuler</a>
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