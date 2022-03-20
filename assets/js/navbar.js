let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;
 arrowParent.classList.toggle("showMenu");
  });
}



let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
console.log("Menu is succesvol ingeladen");
sidebarBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("close");
});

sidebar.classList.toggle("close");

<<<<<<< Updated upstream

console.log("Het menu is ingeladen");
=======
let logout = document.querySelector(".bx-log-out");
logout.addEventListener("click", ()=>{
    document.location.href = "logout.php";
    console.log("Log out knop is ook geladen")
});

>>>>>>> Stashed changes
