const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#closebtn");
const themeToggler = document.querySelector(".theme-toggler");
const news = document.getElementById("upd");

var darkMode;
var lightMode;
var dTime = (new Date()).getHours(); //Get time of day 24h format
var dcheck;

if(dTime > 7 && dTime < 18){
    console.log("day");
    console.log(dTime);
    dcheck = "day";
}else{
    console.log("night");
    console.log(dTime);
    dcheck = "night";
}

if(dcheck == "night"){
    document.body.classList.add('dark-theme-variables');
    themeToggler.querySelector('i:nth-child(2)').classList.toggle('active');
}else if(dcheck == "day"){
    document.body.classList.remove('dark-theme-variables');
    themeToggler.querySelector('i:nth-child(1)').classList.toggle('active');
}



menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});

closeBtn.addEventListener('click', () =>{
    sideMenu.style.display = 'none';
});




themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables');
    themeToggler.querySelector('i:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('i:nth-child(2)').classList.toggle('active');

    
});