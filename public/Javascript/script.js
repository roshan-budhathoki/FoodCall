let menu = document.querySelector('#menu-bar');
let navbar = document.querySelector('.navbar');

menu.onclick = () =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
}
window.onscroll = () =>{
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
}

var Show_login = document.getElementById('Show_login');
Show_login.onclick = function(){
  logbox.style.display = 'block';
  Regbox.style.display = 'none';
}

var Show_register = document.getElementById('Show_register');
Show_register.onclick = function(){
  logbox.style.display = 'none';
  Regbox.style.display = 'block';
}


//get modal element
var logbox = document.getElementById('modal');
//get open modal button
var modalbtn = document.getElementById('modalbtn');
//get close btn
var closebtn = document.getElementsByClassName('closebtn')[0];

//function to open modal
if(modalbtn){
  modalbtn.onclick = function(){
    logbox.style.display = 'block';
  }
}

//function to close modal
closebtn.onclick = function (){
  document.getElementById('login_error').value = "";
    document.getElementById('login_email').value = "";
    document.getElementById('login_password').value = "";
    logbox.style.display = 'none';
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == logbox) {
      logbox.style.display = "none";
    }
  }


//get modal element
var logbox = document.getElementById('modal');
//get open modal button
var modalbtn1 = document.getElementById('modalbtn1');

//function to open modal
if(modalbtn1){
  modalbtn1.onclick = function(){
    logbox.style.display = 'block';
}
}



// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == logbox) {
      logbox.style.display = "none";
    }
  }



//get modal element
var Regbox = document.getElementById('popup');
//get open modal button
var popupbtn = document.getElementById('popupbtn');
//get close btn
var endbtn = document.getElementsByClassName('endbtn')[0];

//function to open modal
if(popupbtn){
  popupbtn.onclick = function(){
    Regbox.style.display = 'block';
}
}

//function to close modal
endbtn.onclick = function (){
  document.getElementById('error').value = "";
  document.getElementById('username').value = "";
  document.getElementById('email').value = "";
  document.getElementById('address').value = "";
  document.getElementById('contact').value = "";
  document.getElementById('password').value = "";
    Regbox.style.display = 'none';
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == Regbox) {
      Regbox.style.display = "none";
    }
}



//get modal element
var Regbox = document.getElementById('popup');
//get open modal button
var popupbtn1 = document.getElementById('popupbtn1');

//function to open modal
if (popupbtn1){
  popupbtn1.onclick = function(){
    Regbox.style.display = 'block';
  }
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == Regbox) {
      Regbox.style.display = "none";
    }
}



//Get the button:
var mybutton = document.getElementById("scroll-top");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome
}


//loader
function loader(){
    document.querySelector('.loader-container').classList.add('fade-out');
}
function fadeOut(){
    setInterval(loader, 2000);
}
window.onload = fadeOut();


// shopping cart for right
let shoppingCart = document.querySelector('.shopping-cart');

document.querySelector('#cart-btn').onclick = () => {
  if(shoppingCart.classList[1] == "active"){
    profile.classList.remove('active');
    shoppingCart.classList.remove('active');
  }
  else{
    profile.classList.remove('active');
    shoppingCart.classList.add('active');
  }
}

// profile section for right
let profile = document.querySelector('.profile-inner');

document.querySelector('#profile-btn').onclick = () => {
  if(profile.classList[1] == "active"){
    shoppingCart.classList.remove('active');
    profile.classList.remove('active');
  }
  else{
    shoppingCart.classList.remove('active');
    profile.classList.add('active');
  }
}

// shopping cart for left
let shippingCart = document.querySelector('.shopping-cart');

document.querySelector('#cart1').onclick = () => {
  if(shippingCart.classList[1] == "active"){
    profiles.classList.remove('active');
    shippingCart.classList.remove('active');
  }
  else{
    profiles.classList.remove('active');
    shippingCart.classList.add('active');
  }
}

// profile section for left
let profiles = document.querySelector('.profile-inner');

document.querySelector('#profile1').onclick = () => {
  if(profiles.classList[1] == "active"){
    shippingCart.classList.remove('active');
    profiles.classList.remove('active');
  }
  else{
    shippingCart.classList.remove('active');
    profiles.classList.add('active');
  }
 
}













