let galleryImages = document.querySelectorAll(".gallery-img");
let gatLatestOpenedImg;
let windowWidth = window.innerWidth;

if(galleryImages){
    galleryImages.forEach(function(image, index){
        image.onclick =function(){
         let getElementCss = window.getComputedStyle(image);
         let getFullImgUrl= getElementCss.getPropertyValue('background-image');
         let getImgUrlPos=getFullImgUrl.split("/img/");//images
         let SetNewImgUrl=getImgUrlPos[1].replace('")','');
          // alert(SetNewImgUrl);
          gatLatestOpenedImg=index + 1;
            // image Pope
          let container=document.body;
          let newImgWindow=document.createElement("div");
          container.appendChild(newImgWindow);
          newImgWindow.setAttribute("class","img-window");
          newImgWindow.setAttribute("onclick","closeImg()");
          

          let newImg=document.createElement("img");
          newImgWindow.appendChild(newImg);
          newImg.setAttribute('src',"img/"+ SetNewImgUrl);
          newImg.setAttribute('id',"current-img");

          
          newImg.onload= function (){
            let imgWidth=this.width;
             let calcImgToEdge = ((windowWidth - imgWidth) / 2) - 80;
              //button de slide
              
               //suivant 
          
          let newNextBtn =document.createElement("a"); 
          let BtnNextText =document.createTextNode(">"); 
          newNextBtn.appendChild(BtnNextText);
          container.appendChild(newNextBtn);
          newNextBtn.setAttribute("class","img-btn-Next");
          newNextBtn.setAttribute("onclick","ChangeImg(1)");
          newNextBtn.style.cssText="right :" + calcImgToEdge + "px;";

          //previous 
          let newPrevBtn =document.createElement("a"); 
          let BtnPrevText =document.createTextNode("<"); 
          newPrevBtn.appendChild(BtnPrevText);
          container.appendChild(newPrevBtn);
          newPrevBtn.setAttribute("class","img-btn-prev");
          newPrevBtn.setAttribute("onclick","ChangeImg(0)");
          newPrevBtn.style.cssText="left :" + calcImgToEdge + "px;";

         
          }
        

        }
    });

}

function closeImg(){
  document.querySelector(".img-window").remove();
  document.querySelector(".img-btn-Next").remove();
  document.querySelector(".img-btn-prev").remove();
}


function ChangeImg(changeDir){
  document.querySelector("#current-img").remove();

  let getImgWindow = document.querySelector('.img-window');

  let newImg = document.createElement("img");

  getImgWindow.appendChild(newImg);

  let CalcNewImg;

  if(changeDir === 1){
    CalcNewImg = gatLatestOpenedImg + 1;

     if(CalcNewImg > galleryImages.length){
         CalcNewImg = 1;
     }
 }
  else if(changeDir === 0){
       CalcNewImg = gatLatestOpenedImg - 1;
     if(CalcNewImg < 1){
          CalcNewImg = galleryImages.length;
      }
  }
  newImg.setAttribute("src","img/img" +CalcNewImg +".jpg");
  newImg.setAttribute("id","current-img");
  gatLatestOpenedImg=CalcNewImg;

}

galleryImages.onload =function(){
let imgWidth=this.width;
calcImgToEdge = ((windowWidth -imgWidth) / 2 )- 80;

let nextBtn = document.querySelector(".img-btn-Next");
nextBtn.style.cssText="right :"+ calcImgToEdge +"px;";

let PrevBtn = document.querySelector(".img-btn-prev");
PrevBtn.style.cssText="right :"+ calcImgToEdge +"px;";
}