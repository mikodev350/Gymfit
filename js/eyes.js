
//eyes n 1
document.getElementById("look_Pasword").addEventListener("click", function(e){
    var pwd = document.getElementById("pwd");
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
    var pwd = document.getElementById("pwd1");
    if(pwd.getAttribute("type")=="password"){
        pwd.setAttribute("type","text");
        document.getElementById("look_Pasword2").style.color="#007BFF";

    } else {
        pwd.setAttribute("type","password");
        document.getElementById("look_Pasword2").style.color="black";

    }
});