//admin sidbar
let sidebar = document.querySelector(".sidebar");
let sidebarDash = document.querySelector(".sidebarDash");

sidebarDash.onclick = function(){
  sidebar.classList.toggle("active")
}



document.querySelector("#modalbtn").addEventListener("click",function(){
  document.querySelector(".modaal").style.display="block";
});

document.querySelector(".popup .close-btn").addEventListener("click",function(){
  document.querySelector(".modaal").style.display="none";
});












// // Get the modal
// var resmodaal = document.getElementById("resadd");

// // Get the button that opens the modal
// var addsbtn = document.getElementById("resmodalbtn");

// // Get the <span> element that closes the modal
// var closedbtn = document.getElementsByClassName("closedbtn")[0];

// // When the user clicks on the button, open the modal
// addsbtn.onclick = function() {
//   resmodaal.style.display = "block";
// }

// // When the user clicks on <span> (x), close the modal
// closedbtn.onclick = function() {
//   resmodaal.style.display = "none";
// }